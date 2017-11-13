<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;

class PreguntaController extends Controller
{

     public function show($id)
     {
         $pregunta= Pregunta::find($id);
         if(!$pregunta){
           return response()->json(['mensaje'=>'No se encontraro la pregunta', 'code'=>404],404);
         }else {
           return response()->json(['datos'=>$pregunta],202);
         }
     }

}
