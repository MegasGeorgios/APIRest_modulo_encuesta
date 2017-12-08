<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Encuesta;
use App\Pregunta;
use App\Opciones;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function rpd_encuesta($id)
     {
         $encuesta= Encuesta::where('id',$id)->with('preguntas.op')->get();
         if(!$encuesta){
           return response()->json(['mensaje'=>'No se encontro encuesta', 'status'=>'error'],404);
         }

        return response()->json([ 'datos'=>$encuesta ],202);

     }
    public function index()
    {
        $encuestas= Encuesta::all();
        if(!$encuestas){
          return response()->json(['mensaje'=>'No se encontraron encuestas', 'status'=>'error'],404);
        }else {
          return response()->json(['datos'=>$encuestas],202);
        }
    }

    public function store(Request $request)
    {
        //
        if (!$request->get('titulo') || !$request->get('descripcion') || !$request->get('fecha_inicio') ||
            !$request->get('fecha_fin') || !$request->get('ambito')
            ){
              return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'status'=>'error'],422);
            }
        $encuesta=Encuesta::create($request->all());
        $id=$encuesta->id;
        return response()->json(['mensaje'=>'Se ha creado la encuesta satisfactoriamente','id'=>$id, 'status'=>'ok'],202);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encuesta= Encuesta::find($id);
        if(!$encuesta){
          return response()->json(['mensaje'=>'No se encontraro la encuesta', 'status'=>'error'],404);
        }else {

          if ( strtotime(date("Y-m-d")) >= strtotime($encuesta->fecha_inicio) && strtotime(date("Y-m-d")) <= strtotime($encuesta->fecha_fin) ){
            $status_encuesta="abierta";
          }else {
            $status_encuesta="cerrada";
          }
          return response()->json(['datos'=>$encuesta, 'estatus_encuesta'=>$status_encuesta],202);
        }
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

   public function update(Request $request, $id)
 {

   if (isset($request->titulo) &&
      isset($request->descripcion) &&
      isset($request->fecha_inicio) &&
      isset($request->fecha_fin) &&
      isset($request->ambito)
   ){

      $encuesta=Encuesta::find($id)->update($request->all());
      return response()->json(['mensaje'=>'Se han actualizado los datos correctamente', 'status'=>'error'],202);
  }else {
      return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'status'=>'ok'],422);
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
        $encuesta = Encuesta::find($id);

        if(!$encuesta){
          return response()->json(['mensaje'=>'No se encontro la $encuesta', 'status'=>'error'],404);
        }

        $encuesta->delete();
        return response()->json(['mensaje'=>'Se ha eliminado la $encuesta correctamente', 'status'=>'ok'],202);

    }
}
