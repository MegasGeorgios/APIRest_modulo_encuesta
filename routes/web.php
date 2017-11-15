<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ruta para listar encuestas
Route::get('/', function () {
    return view('encuestas');
});

//ruta para listar encuestas
Route::get('/encuestas', function () {
    return view('encuestas');
});

//ruta para crear encuesta
Route::get('/encuesta', function () {
    return view('encuesta');
});

//ruta para editar encuesta
Route::get('/encuesta/{id}/preguntas', function ($id) {
    return view('editar-encuesta', ['idEncuesta' => $id]);
});

//ruta para editar encuesta
Route::get('/encuesta/{id}', function ($id) {
    return view('responder-encuesta', ['idEncuesta' => $id]);
});

//ruta para eliminar encuesta
Route::any('eliminar-encuesta/{id}', ['as' => 'eliminar-encuesta', 'uses' => 'EncuestaController@destroy']);

//crear pregunta
Route::get('/encuesta/{id}/agregar-pregunta', function ($id) {
    return view('pregunta', ['idEncuesta' => $id]);
});

//agregar opciones
Route::get('/opciones-pregunta', function () {
    return view('opciones-pregunta');
});

//editar pregunta
Route::get('/pregunta/{id}', function ($id) {
    return view('editar-pregunta', ['idPregunta' => $id]);
});

//eliminar pregunta
Route::any('eliminar-pregunta/{id}', ['as' => 'eliminar-pregunta', 'uses' => 'PreguntaController@destroy']);
