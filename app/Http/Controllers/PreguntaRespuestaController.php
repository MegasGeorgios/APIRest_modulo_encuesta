<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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
       $op_val = $rpd->op_val($idEncuesta);
       $opciones = $op_val[0];
       $valoracion = $op_val[1];

       $contadorVal=0;
       $tamVal= sizeof($valoracion);
       $i=0;
       $idVal=0;
       //$arregloVal[0]=0;

       while ( $i < $tamVal ) {
         if ($i != ($tamVal-1)) {

           if ($valoracion[$i]->pregunta_id == $valoracion[$i+1]->pregunta_id) {
             $contadorVal++;
           }else {
             $arregloVal[$idVal]= $contadorVal;
             $idVal++;
           }
         }
         $i++;
          if ($i == ($tamVal-1)) {
            $contadorVal++;
            $arregloVal[$idVal]= $contadorVal;
            $idVal++;
          }

       }


       $tamOp= sizeof($opciones);
       $j=0;
       $idOp=0;
       $contadorOp=0;
       //$arregloOp[0]=0;

       while ( $j < $tamOp ) {
         if ($j != ($tamOp-1)) {

           if ($opciones[$j]->pregunta_id == $opciones[$j+1]->pregunta_id) {
             $contadorOp++;

           }else {
             $arregloOp[$idOp]= $contadorOp;
             $idOp++;
           }
         }
         $j++;
          if ($j == ($tamOp-1)) {
            $contadorOp++;
            $arregloOp[$idOp]= $contadorOp;
            $idOp++;
          }

       }

       $a=0;

       while ($a <  $tamVal) {

         $ArreglografBarra[$a] = [$valoracion[$a]->valoracion, $valoracion[$a]->votos];

         $a++;
       }

       $a=0;
       if (isset($arregloVal)) {
           $tav=sizeof($arregloVal);

         while ($a <  $tav) {
           if ($a==0) {
             $aux=$arregloVal[$a];
             $id=$valoracion[$aux]->pregunta_id;
             $grafBarra[$id] = array_slice($ArreglografBarra, 0, $arregloVal[$a]+1);
           }else {
             $aux=$arregloVal[$a];
             $id=$valoracion[$aux]->pregunta_id;
             $grafBarra[$id] = array_slice($ArreglografBarra, $arregloVal[$a-1]+1, $arregloVal[$a]);
           }

           $a++;
         }
       }

       $a=0;
       while ($a <  $tamOp) {

         $ArreglografTorta[$a] = [$opciones[$a]->opciones, $opciones[$a]->votos];

         $a++;
       }

       $a=0;
       if (isset($arregloOp)) {
         $top=sizeof($arregloOp);

         while ($a <  $top) {
           if ($a==0) {
             $aux=$arregloOp[$a];
             $id=$opciones[$aux]->pregunta_id;
             $grafTorta[$id] = array_slice($ArreglografTorta, 0, $arregloOp[$a]+1);
           }else {
             $aux=$arregloOp[$a];
             $id=$opciones[$aux]->pregunta_id;
             $grafTorta[$id] = array_slice($ArreglografTorta, $arregloOp[$a-1]+1, $arregloOp[$a]);
           }

           $a++;
         }
       }


       $grafTorta[0]=[['-',0],['-',0]];
       $grafBarra[0]=[['-',0],['-',0]];

        return response()->json([
          'datos'=>$encuesta,
          'val'=>$valoracion,
          'op'=>$opciones,
          'grafTorta'=>$grafTorta,
          'grafBarra'=>$grafBarra
        ],
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

    public function store(Request $request,$idEncuesta)
    {
      if(isset($request->texto_libre))
      {
        $tam_tl=sizeof($request->texto_libre);
        $id_tl=$request->id_preg_texto_libre;
        $texto_libre = $request->texto_libre;
        for ($i=0; $i < $tam_tl; $i++) {
          if(!empty($texto_libre[$i]))
          {
          DB::table('respuestas')->insert(
            ['texto_libre' => $texto_libre[$i], 'pregunta_id' => $id_tl[$i]]
          );
          }
        }
      }

      if(isset($request->val))
      {
        $val = $request->val;
        $id_preg_val = $request->id_preg_valoracio;
        $tam_val=sizeof($val);

          for ($i=0; $i < $tam_val; $i++) {
            if(!empty($val[$i]))
            {
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
          if(!empty($opciones[$i]))
          {
          DB::table('respuestas')->insert(
            ['opciones' => $opciones[$i], 'pregunta_id' => $id_op[$i]]
          );
          }
        }
      }

      DB::update('update encuestas set encuestados = encuestados+1 where id = ?', [$idEncuesta]);
      return response()->json(['mensaje'=>'Se ha almacenado la respuesta', 'code'=>202],202);

    }

    public function excel($idEncuesta)
    {
      Excel::create('Resultados', function($excel) use ($idEncuesta){

        $excel->sheet('Resultados', function($sheet) use ($idEncuesta){

          $encuesta=Encuesta::find($idEncuesta);
          $sheet->mergeCells('A1:j1');
          $sheet->mergeCells('A2:j2');
          $sheet->mergeCells('A3:j3');
          $sheet->row(1,['Resultados de la encuesta #'. $idEncuesta]);
          $sheet->row(2,['Titulo: '.$encuesta->titulo]);
          $sheet->row(3,['Descripcion: '.$encuesta->descripcion]);

          $rpd= new Respuesta;
          $op_val = $rpd->op_val($idEncuesta);
          $opciones = $op_val[0];
          $valoracion = $op_val[1];
          $texto_libre = $op_val[2];

          $preguntas = DB::table('preguntas')
               ->where('encuesta_id', '=', $idEncuesta)
               ->get();


          $i=4;
          foreach ($preguntas as $pregunta) {
            if ($pregunta->tipo_respuesta == "texto-libre") {
              $i++;
              $sheet->row($i,[$pregunta->pregunta]);
              $i++;
              $sheet->row($i,['Respuestas:']);
              $i++;
              foreach ($texto_libre as $t_l) {
                if ($pregunta->id == $t_l->pregunta_id)
                {
                  $row= [];
                  $row[0]= $t_l->texto_libre;
                  $sheet->appendRow($row);
                  $i++;
                }
              }
            }
            if ($pregunta->tipo_respuesta == "opciones") {
              $i++;
              $sheet->row($i,[$pregunta->pregunta]);
              $i++;
              $sheet->row($i,['Opcion', 'Votos']);
              $i++;
              foreach ($opciones as $op) {
                if ($pregunta->id == $op->pregunta_id)
                {
                  $row= [];
                  $row[0]= $op->opciones;
                  $row[1]= $op->votos;
                  $sheet->appendRow($row);
                  $i++;
                }
              }
            }
            if ($pregunta->tipo_respuesta == "valoracion") {
              $i++;
              $sheet->row($i,[$pregunta->pregunta]);
              $i++;
              $sheet->row($i,['Valoracion', 'Votos']);
              $i++;
              foreach ($valoracion as $val) {
                if ($pregunta->id == $val->pregunta_id)
                {
                  $row= [];
                  $row[0]= $val->valoracion;
                  $row[1]= $val->votos;
                  $sheet->appendRow($row);
                  $i++;
                }
              }
            }
          }

        });

      })->export('xls');

    }
}
