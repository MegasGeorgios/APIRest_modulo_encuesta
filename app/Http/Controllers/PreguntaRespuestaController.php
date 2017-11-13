<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
use App\Respuesta;

class PreguntaRespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($id)
     {
         $pregunta= Pregunta::find($id);
         $respuestas= $pregunta->respuestas;
         if(!$pregunta){
           return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
         }

          return response()->json(['datos'=>$respuestas],202);

     }

    public function store(Request $request, $id_pregunta)
    {
      
      if ($request->get('texto_libre') or $request->get('valoracion') or $request->get('opciones'))
      {
        $pregunta= Pregunta::find($id_pregunta);
        if(!$pregunta){
          return response()->json(['mensaje'=>'No se encontraro la pregunta', 'code'=>404],404);
        }

        $pregunta->respuestas()->create($request->all());

        return response()->json(['mensaje'=>'Se ha almacenado la respuesta', 'code'=>202],202);

      }

      return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);


    }

}
