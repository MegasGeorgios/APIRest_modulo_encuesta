<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;

class PreguntaController extends Controller
{

     public function show($id)
     {
         $pregunta= Pregunta::find($id);
         if(!$pregunta){
           return response()->json(['mensaje'=>'No se encontraro la pregunta', 'code'=>404],404);
         }else {
           return response()->json(['datos'=>$pregunta],202);
         }
     }

     public function update(Request $request, $id_pregunta)
     {

         $pregunta = Pregunta::find($id_pregunta);
         if(!$pregunta){
           return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
         }

         if (isset($request->pregunta) &&
            isset($request->aclaratoria) &&
            isset($request->tipo_respuesta)
         ){

           $pregunta->update([
             'pregunta' => $request->pregunta,
             'aclaratoria' => $request->aclaratoria,
             'tipo_respuesta' => $request->tipo_respuesta,
           ]);

            return response()->json(['mensaje'=>'Se han actualizado los datos correctamente', 'code'=>202],202);
        }else {
            return response()->json(['mensaje'=>'Datos invalidos o incompletos', 'code'=>422],422);
        }
     }

     public function destroy($id)
     {

         $pregunta = Pregunta::find($id);

         if(!$pregunta){
           return response()->json(['mensaje'=>'No se encontro la pregunta', 'code'=>404],404);
         }

         $pregunta->delete();
         return response()->json(['mensaje'=>'Se ha eliminado la pregunta correctamente', 'code'=>202],202);

     }

}
