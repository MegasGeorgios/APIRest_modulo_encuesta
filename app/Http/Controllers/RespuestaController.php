<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Respuesta;

class RespuestaController extends Controller
{

     public function store(Request $request)
     {
       dd($request);
       $respuestas = $request->rpd[0];

       //Respuesta::create($request->all());
       //return $respuestas;
       DB::table('respuestas')->insert(
         ['texto_libre' => $respuestas->respuesta, 'pregunta_id' => $respuestas->pregunta_id ]
       );


     }
}
