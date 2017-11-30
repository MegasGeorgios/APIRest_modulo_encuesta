<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Encuesta;
use App\Pregunta;
use App\Respuesta;

class PreguntaRespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function respuestas_op_val($idEncuesta)
     {
       $encuesta= Encuesta::where('id',$idEncuesta)->with('preguntas.op')->get();

       $rpd= new Respuesta;
       $op_val = $rpd->op_val();
       $opciones = $op_val[0];
       $valoracion = $op_val[1];
       $totalEncuestados= $rpd->num_encuestados($idEncuesta);

        return response()->json([
          'datos'=>$encuesta,
          'val'=>$valoracion,
          'op'=>$opciones,
          'totalEncuestados'=>$totalEncuestados],
          202);
    }

     public function index($idPregunta)
     {
                 $t_l = DB::table('respuestas')
                      ->select('texto_libre')
                      ->where('pregunta_id', '=', $idPregunta)
                      ->get();

        return response()->json(['texto_libre'=>$t_l],202);

     }

    public function store(Request $request)
    {
      if(isset($request->texto_libre))
      {
        $tam_tl=sizeof($request->texto_libre);
        $id_tl=$request->id_preg_texto_libre;
        $texto_libre = $request->texto_libre;
        for ($i=0; $i < $tam_tl; $i++) {
          DB::table('respuestas')->insert(
            ['texto_libre' => $texto_libre[$i], 'pregunta_id' => $id_tl[$i]]
          );
        }
      }

      if(isset($request->val))
      {
            $val = $request->val;
            $id_preg_val = $request->id_preg_valoracio;
            $tam_val=sizeof($val);

            if (isset($val))
            {
              for ($i=0; $i < $tam_val; $i++) {
                DB::table('respuestas')->insert(
                  ['valoracion' => $val[$i], 'pregunta_id' => $id_preg_val[$i]]
                );
              }
            }

      }

      if(isset($request->opciones))
      {
        $tam_op=sizeof($request->opciones);
        $id_op=$request->id_preg_opciones;
        $opciones = $request->opciones;
        for ($i=0; $i < $tam_op; $i++) {
          DB::table('respuestas')->insert(
            ['opciones' => $opciones[$i], 'pregunta_id' => $id_op[$i]]
          );
        }
      }


      return response()->json(['mensaje'=>'Se ha almacenado la respuesta', 'code'=>202],202);

    }

}
