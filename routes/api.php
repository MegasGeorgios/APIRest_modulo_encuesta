<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('encuestas','EncuestaController', ['except'=>['edit','create'] ]);
Route::resource('encuesta.preguntas','EncuestaPreguntaController', ['except'=>['show','edit','create','update','destroy'] ]);
Route::resource('preguntas','PreguntaController', [ 'only'=>['show','update','destroy'] ]);
Route::resource('pregunta.opciones','PreguntaOpcionesController', [ 'only'=>['index', 'store','update'] ]);
//Route::resource('pregunta.respuestas','PreguntaRespuestaController', ['except'=>['show','edit','create','update'] ]);
//Route::resource('respuestas','RespuestaController', [ 'only'=>['show'] ]);
