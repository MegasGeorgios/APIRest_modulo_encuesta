<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RespuestaController extends Controller
{

     public function store(Request $request)
     {
       DB::table('respuestas')->insert(
         ['texto_libre' => , 'pregunta_id' => ]
       );
     }
}
