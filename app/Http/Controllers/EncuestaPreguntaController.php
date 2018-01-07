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
     public function resultados($idEncuesta)
     {
         $encuesta= Encuesta::find($idEncuesta);
         if(!$encuesta){
           return response()->json(['mensaje'=>'No se encontro encuesta', 'status'=>'error'],404);
         }

        return response()->json([ 'datos'=>$encuesta ],202);

     }
     public function index($id)
     {
         $encuesta= Encuesta::find($id);
         if(!$encuesta){
           return response()->json(['mensaje'=>'No se encontro encuesta', 'status'=>'error'],404);
         }

         $preguntas= $encuesta->preguntas;

        return response()->json([ 'datos'=>$encuesta ],202);

     }


    public function store(Request $request, $id_encuesta)
    {

      if (!$request->get('pregunta') || !$request->get('tipo_respuesta'))
      {
          return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'status'=>'error'],422);
      }

      $encuesta= Encuesta::find($id_encuesta);
      if(!$encuesta){
        return response()->json(['mensaje'=>'No se encontro la encuesta', 'status'=>'error'],404);
      }

      if (!$request->input('aclaratoria'))
      {
        $aclaratoria=' ';

      }else {
        $aclaratoria=$request->aclaratoria;
      }

      if (!$request->input('valoracion_min') && !$request->input('valoracion_max') )
      {
        $pregunta= $encuesta->preguntas()->create([
          'pregunta' => $request->pregunta,
          'aclaratoria' => $aclaratoria,
          'tipo_respuesta' => $request->tipo_respuesta,
        ]);
      }else {
        $pregunta = new Pregunta;
        $pregunta->pregunta = $request->pregunta;
        $pregunta->aclaratoria = $aclaratoria;
        $pregunta->tipo_respuesta = $request->tipo_respuesta;
        $pregunta->valoracion_min = $request->valoracion_min;
        $pregunta->valoracion_max = $request->valoracion_max;
        $pregunta->etiqueta_min = $request->etiqueta_min;
        $pregunta->etiqueta_max = $request->etiqueta_max;
        $pregunta->encuesta_id = $id_encuesta;
        $pregunta->save();

      }


      return response()->json(['mensaje'=>'Pregunta agregada', 'status'=>'ok'],202);

    }



}
