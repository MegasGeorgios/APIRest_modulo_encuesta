<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
use App\Opciones;

class PreguntaOpcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $pregunta= Pregunta::find($id);
      if(!$pregunta){
        return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
      }

      $opciones= $pregunta->opciones;
       return response()->json(['datos'=>$opciones],202);
    }


    public function store(Request $request, $id_pregunta)
    {
      $tam=sizeof($request);
      dd($tam);
      $pregunta= Pregunta::find($id_pregunta);
      if(!$pregunta){
        return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
      }

      $opciones= $pregunta->opciones()->create($request->all());

      return response()->json(['mensaje'=>'Se han almacenado satisfactoriamente', 'code'=>202],202);

    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
