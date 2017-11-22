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

//ruta para responder encuesta
Route::get('/encuesta/{id}', function ($id) {
    return view('responder-encuesta', ['idEncuesta' => $id]);
});
Route::post('/rpd_encuesta', 'PreguntaRespuestaController@store');

//ruta para eliminar encuesta
Route::any('eliminar-encuesta/{id}', ['as' => 'eliminar-encuesta', 'uses' => 'EncuestaController@destroy']);

//crear pregunta
Route::get('/encuesta/{id}/agregar-pregunta', function ($id) {
    return view('pregunta', ['idEncuesta' => $id]);
});

//editar pregunta sin opciones
Route::get('/pregunta/{id}', function ($id) {
    return view('editar-pregunta', ['idPregunta' => $id]);
});

//editar pregunta con Opciones (vista)
Route::get('/pregunta/{id}/opciones', function ($id) {
    return view('editar-pregunta-opciones', ['idPregunta' => $id]);
});
Route::any('/act-pregunta-opciones/{id}', 'PreguntaOpcionesController@update');

//eliminar opcion
Route::any('eliminar-opcion/{id}', ['as' => 'eliminar-opcion', 'uses' => 'PreguntaOpcionesController@destroy']);

//eliminar pregunta
Route::any('eliminar-pregunta/{id}', ['as' => 'eliminar-pregunta', 'uses' => 'PreguntaController@destroy']);

//resultados
Route::get('/resultados/encuesta/{id}', function ($id) {
    return view('resultados', ['idEncuesta' => $id]);
});

Route::get('/pregunta/{id}/respuestas_tl', function ($id) {
    return view('respuesta_tl', ['idPregunta' => $id]);
});
Route::get('/pregunta/{id}/respuestas_val', function ($id) {
    return view('respuesta_val', ['idPregunta' => $id]);
});
Route::get('/pregunta/{id}/respuestas_op', function ($id) {
    return view('respuesta_op', ['idPregunta' => $id]);
});
