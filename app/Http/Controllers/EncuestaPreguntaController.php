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

      if (!$request->get('valoracion_min') && !$request->get('valoracion_max') )
      {
        if (!$request->get('aclaratoria'))
        {
          $aclaratoria=' ';

        }else {
          $aclaratoria=$request->aclaratoria;
        }
        $pregunta= $encuesta->preguntas()->create([
          'pregunta' => $request->pregunta,
          'aclaratoria' => $aclaratoria,
          'tipo_respuesta' => $request->tipo_respuesta,
        ]);
      }else {
        $pregunta= $encuesta->preguntas()->create($request->all());
      }


      return response()->json(['mensaje'=>'Pregunta agregada', 'status'=>'ok'],202);

    }



}
