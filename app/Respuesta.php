<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Respuesta extends Model
{
  protected $table = 'respuestas';

  protected $fillable = [
      'texto_libre', 'valoracion', 'opciones'
  ];

  public function pregunta()
  {
    // 1 respuesta pertenece a una pregunta
    return $this->belongsTo('App\Pregunta' , 'pregunta_id');
  }

  public function op_val()
  {
    $op = DB::table('respuestas')
         ->select(DB::raw('count(opciones) as votos, opciones, pregunta_id'))
         ->groupBy('pregunta_id','opciones')
         ->get();

    $val = DB::table('respuestas')
         ->select(DB::raw('count(valoracion) as votos, valoracion, pregunta_id'))
         ->groupBy('pregunta_id','valoracion')
         ->get();
    return $op_val = array($op,$val);
  }
  
  public function num_encuestados($idEncuesta)
  {
      $valr=DB::table('respuestas')
           ->select('respuestas.valoracion')
           ->join('preguntas', 'preguntas.id', '=', 'respuestas.pregunta_id')
           ->where('respuestas.valoracion','<>','NULL')
           ->where('preguntas.encuesta_id',$idEncuesta)
           ->get();
     $opc=DB::table('respuestas')
          ->select('respuestas.opciones')
          ->join('preguntas', 'preguntas.id', '=', 'respuestas.pregunta_id')
          ->where('respuestas.opciones','<>','NULL')
          ->where('preguntas.encuesta_id',$idEncuesta)
          ->get();
     $tlb=DB::table('respuestas')
         ->select('respuestas.texto_libre')
         ->join('preguntas', 'preguntas.id', '=', 'respuestas.pregunta_id')
         ->where('respuestas.texto_libre','<>','NULL')
         ->where('preguntas.encuesta_id',$idEncuesta)
         ->get();

      $countVal=count($valr);
      $countOpc=count($opc);
      $countTlb=count($tlb);

      if (($countVal >= $countOpc) && ($countVal >= $countTlb) ) {
          $num=$countVal;
      }else{
        if (($countOpc >= $countVal) && ($countOpc >= $countTlb)) {
          $num=$countOpc;
        }else {
          if (($countTlb >= $countVal) && ($countTlb >= $countOpc)) {
          $num=$countTlb;
          }
        }
      }

      return $num;
  }
}
