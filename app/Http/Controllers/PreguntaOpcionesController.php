<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

         $ops= $pregunta->op;

        return response()->json([ 'datos'=>$pregunta ],202);

     }


    public function store(Request $request, $id_pregunta)
    {

      $pregunta= Pregunta::find($id_pregunta);
      if(!$pregunta){
        return response()->json(['mensaje'=>'No se encontro la pregunta', 'status'=>'error'],404);
      }

        $opciones = $request->opciones;
          DB::table('opciones')->insert(
            ['opcion' => $opciones, 'pregunta_id' => $id_pregunta]
          );


      return response()->json(['mensaje'=>'Se han almacenado satisfactoriamente', 'status'=>'ok'],202);

    }

    public function update(Request $request, $id_pregunta)
    {
        $pregunta = Pregunta::find($id_pregunta);
        if(!$pregunta){
          return response()->json(['mensaje'=>'No se encontro la pregunta', 'status'=>'error'],404);
        }

        if (isset($request->pregunta) &&
           isset($request->aclaratoria)
        ){

          $tipo_respuesta= 'opciones';

          $pregunta->update([
            'pregunta' => $request->pregunta,
            'aclaratoria' => $request->aclaratoria,
            'tipo_respuesta' => $tipo_respuesta,
          ]);


           return response()->json(['mensaje'=>'Se han actualizado los datos correctamente', 'status'=>'ok'],202);
       }else {
           return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'status'=>'error'],422);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $opcion = Opciones::find($id);

      if(!$opcion){
        return response()->json(['mensaje'=>'No se encontro la opcion', 'status'=>'error'],404);
      }

      $opcion->delete();
      return response()->json(['mensaje'=>'Se ha eliminado la opcion correctamente', 'status'=>'ok'],202);

    }
}
