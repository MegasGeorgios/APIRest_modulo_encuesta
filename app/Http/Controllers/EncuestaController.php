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
           return response()->json(['mensaje'=>'No se encontro encuesta', 'code'=>404],404);
         }

        return response()->json([ 'datos'=>$encuesta ],202);

     }
    public function index()
    {
        $encuestas= Encuesta::all();
        if(!$encuestas){
          return response()->json(['mensaje'=>'No se encontraron encuestas', 'code'=>404],404);
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
              return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);
            }
        Encuesta::create($request->all());
        return response()->json(['mensaje'=>'Se ha creado la encuesta satisfactoriamente', 'code'=>202],202);

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
          return response()->json(['mensaje'=>'No se encontraro la encuesta', 'code'=>404],404);
        }else {
          return response()->json(['datos'=>$encuesta],202);
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
  //$variable = $request -> all();
  //$variable->titulo es el titulo de la encuesta y asi con todas las propiedades
   if (isset($request->titulo) &&
      isset($request->descripcion) &&
      isset($request->fecha_inicio) &&
      isset($request->fecha_fin) &&
      isset($request->ambito)
   ){

     $encuesta=Encuesta::find($id);
     if (!$encuesta)
     {
       return response()->json(['mensaje'=>'No se encontraro la encuesta', 'code'=>404],404);
     }
     $encuesta->update([
       'titulo' => $request->titulo,
       'descripcion' => $request->descripcion,
       'fecha_inicio' => $request->fecha_inicio,
       'fecha_fin' => $request->fecha_fin,
       'ambito' => $request->ambito,
     ]);

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
        $encuesta = Encuesta::find($id);

        if(!$encuesta){
          return response()->json(['mensaje'=>'No se encontro la $encuesta', 'code'=>404],404);
        }

        $encuesta->delete();
        return response()->json(['mensaje'=>'Se ha eliminado la $encuesta correctamente', 'code'=>202],202);

    }
}
