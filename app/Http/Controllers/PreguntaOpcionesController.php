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
      $tam=sizeof($request->opciones);
      //dd($tam);
      $pregunta= Pregunta::find($id_pregunta);
      if(!$pregunta){
        return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
      }

        $opcion = new opciones;
        $opciones = $request->opciones;
        for ($i=0; $i < $tam; $i++) {
          DB::table('opciones')->insert(
            ['opcion' => $opciones, 'pregunta_id' => $id_pregunta]
          );
        }


      return response()->json(['mensaje'=>'Se han almacenado satisfactoriamente', 'code'=>202],202);

    }

    public function update(Request $request, $id_pregunta)
    {
        $pregunta = Pregunta::find($id_pregunta);
        if(!$pregunta){
          return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
        }

        if (isset($request->pregunta) &&
           isset($request->aclaratoria) &&
           isset($request->opciones)
        ){

          $tipo_respuesta= 'opciones';

          $pregunta->update([
            'pregunta' => $request->pregunta,
            'aclaratoria' => $request->aclaratoria,
            'tipo_respuesta' => $tipo_respuesta,
          ]);

          $tam=sizeof($request->opciones);

          $opcion = new Opciones;
          $opciones = $request->opciones;
          $id_op= $request->id_op;

          for ($i=0; $i < $tam; $i++) {
            DB::table('opciones')->where('id', $id_op[$i])
            ->update( ['opcion' => $opciones[$i], 'pregunta_id' => $id_pregunta] );
          }

           return response()->json(['mensaje'=>'Se han actualizado los datos correctamente', 'code'=>202],202);
       }else {
           return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);
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
        return response()->json(['mensaje'=>'No se encontro la opcion', 'code'=>404],404);
      }

      $opcion->delete();
      return response()->json(['mensaje'=>'Se ha eliminado la opcion correctamente', 'code'=>202],202);

    }
}
