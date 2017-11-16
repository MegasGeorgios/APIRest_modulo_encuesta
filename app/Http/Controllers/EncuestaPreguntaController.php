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

        return response()->json([ 'datos'=>$encuesta ],202);

     }


    public function store(Request $request, $id_encuesta)
    {

      if (!$request->get('pregunta') || !$request->get('aclaratoria') || !$request->get('tipo_respuesta'))
      {
          return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);
      }

      $encuesta= Encuesta::find($id_encuesta);
      if(!$encuesta){
        return response()->json(['mensaje'=>'No se encontro la encuesta', 'code'=>404],404);
      }

      $pregunta= $encuesta->preguntas()->create($request->all());

      return response()->json(['mensaje'=>'Pregunta agregada', 'code'=>202],202);

    }



}
