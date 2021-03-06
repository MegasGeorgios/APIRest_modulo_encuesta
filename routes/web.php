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
Route::get('/encuestas', function () {
    return view('VistasModuloEncuesta.encuestas');
});

//ruta para crear encuesta
Route::get('/encuesta', function () {
    return view('VistasModuloEncuesta.encuesta');
});
//encuesta creada
Route::get('/encuesta-creada/{id}', function ($id) {
    return view('VistasModuloEncuesta.encuesta-creada', ['idEncuesta' => $id]);
});
//ruta para editar encuesta
Route::get('/encuesta/{id}/preguntas', function ($id) {
    return view('VistasModuloEncuesta.editar-encuesta', ['idEncuesta' => $id]);
});
Route::get('/edit-encuesta/{id}', function ($id) {
    return view('VistasModuloEncuesta.editar-encuesta', ['idEncuesta' => $id]);
});
//ruta para responder encuesta
Route::get('/encuesta/{id}', function ($id) {
    return view('VistasModuloEncuesta.responder-encuesta', ['idEncuesta' => $id]);
});
Route::post('/rpd_encuesta', 'PreguntaRespuestaController@store');

//ruta para eliminar encuesta
Route::any('eliminar-encuesta/{id}', ['as' => 'eliminar-encuesta', 'uses' => 'EncuestaController@destroy']);

//crear pregunta
Route::get('/encuesta/{id}/agregar-pregunta', function ($id) {
    return view('VistasModuloEncuesta.pregunta', ['idEncuesta' => $id]);
});

//editar pregunta sin opciones
Route::get('/pregunta/{id}', function ($id) {
    return view('VistasModuloEncuesta.editar-pregunta', ['idPregunta' => $id]);
});

//editar pregunta con Opciones (vista)
Route::get('/pregunta/{id}/opciones', function ($id) {
    return view('VistasModuloEncuesta.editar-pregunta-opciones', ['idPregunta' => $id]);
});
Route::any('/act-pregunta-opciones/{id}', 'PreguntaOpcionesController@update');

//eliminar opcion
Route::any('eliminar-opcion/{id}', ['as' => 'eliminar-opcion', 'uses' => 'PreguntaOpcionesController@destroy']);

//eliminar pregunta
Route::any('eliminar-pregunta/{id}', ['as' => 'eliminar-pregunta', 'uses' => 'PreguntaController@destroy']);

//resultados
Route::get('/resultados/encuesta/{id}', function ($id) {
    return view('VistasModuloEncuesta.resultados', ['idEncuesta' => $id]);
});

Route::get('/pregunta/{id}/respuestas_tl', function ($id) {
    return view('VistasModuloEncuesta.respuesta_tl', ['idPregunta' => $id]);
});
