<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Encuesta;
use App\Pregunta;

class EncuestaPreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($id)
     {
         $encuesta= Encuesta::find($id);
         if(!$encuesta){
           return response()->json(['mensaje'=>'No se encontro encuesta', 'code'=>404],404);
         }

         $preguntas= $encuesta->preguntas;
          return response()->json(['datos'=>$preguntas],202);

     }


    public function store(Request $request, $id_encuesta)
    {

      if (!$request->get('pregunta') || !$request->get('aclaratoria') || !$request->get('tipo_respuesta'))
      {
          return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);
      }

      $encuesta= Encuesta::find($id_encuesta);
      if(!$encuesta){
        return response()->json(['mensaje'=>'No se encontraro la encuesta', 'code'=>404],404);
      }

      $pregunta= $encuesta->preguntas()->create($request->all());

      return response()->json(['datos'=> $pregunta, 'code'=>202],202);

    }

    public function update(Request $request,$id_encuesta, $id_pregunta)
    {

        $encuesta=Encuesta::find($id_encuesta);
        if(!$encuesta){
          return response()->json(['mensaje'=>'No se encontro la encuesta', 'code'=>404],404);
        }

        $pregunta = $encuesta->preguntas()->find($id_pregunta);
        if(!$pregunta){
          return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
        }

        if (isset($request->pregunta) &&
           isset($request->aclaratoria) &&
           isset($request->tipo_respuesta)
        ){

          $encuesta->update([
            'pregunta' => $request->pregunta,
            'aclaratoria' => $request->aclaratoria,
            'tipo_respuesta' => $request->tipo_respuesta,
          ]);

           return response()->json(['mensaje'=>'Se han actualizado los datos correctamente', 'code'=>202],202);
       }else {
           return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);
       }
    }

    public function destroy($id_encuesta, $id_pregunta)
    {
        $encuesta=Encuesta::find($id_encuesta);

        if(!$encuesta){
          return response()->json(['mensaje'=>'No se encontraron encuestas', 'code'=>404],404);
        }

        $pregunta = $encuesta->preguntas()->find($id_pregunta);

        if(!$pregunta){
          return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
        }

        $pregunta->delete();
        return response()->json(['mensaje'=>'Se ha eliminado la pregunta correctamente', 'code'=>202],202);

    }
}
