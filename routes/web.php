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

Route::get('/', function () {
    return view('encuestas');
});

Route::get('/encuestas', function () {
    return view('encuestas');
});

Route::get('/encuesta', function () {
    return view('encuesta');
});

Route::get('/encuesta/{id}', function () {
    return view('editar-encuesta');
});

Route::get('/encuesta/{id}/preguntas', function () {
    return view('editar-pregunta');
});

Route::get('/opciones-pregunta', function () {
    return view('opciones-pregunta');
});

Route::get('/pregunta', function () {
    return view('pregunta');
});
