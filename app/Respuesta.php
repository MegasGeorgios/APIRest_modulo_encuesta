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

  public function op_val($idEncuesta)
  {
    $t_l = DB::table('respuestas')
      ->join('preguntas', 'preguntas.id', '=', 'respuestas.pregunta_id')
      ->join('encuestas', 'encuestas.id', '=', 'preguntas.encuesta_id')
         ->select( 'respuestas.texto_libre', 'respuestas.pregunta_id')
         ->where('respuestas.texto_libre','<>','NULL')
         ->where('encuestas.id',$idEncuesta)
         ->groupBy('respuestas.pregunta_id','respuestas.texto_libre')
         ->get();

    $op = DB::table('respuestas')
      ->join('preguntas', 'preguntas.id', '=', 'respuestas.pregunta_id')
      ->join('encuestas', 'encuestas.id', '=', 'preguntas.encuesta_id')
         ->select(DB::raw('count(opciones) as votos, opciones, pregunta_id'))
         ->where('respuestas.opciones','<>','NULL')
         ->where('encuestas.id',$idEncuesta)
         ->groupBy('pregunta_id','opciones')
         ->get();

    $val = DB::table('respuestas')
    ->join('preguntas', 'preguntas.id', '=', 'respuestas.pregunta_id')
    ->join('encuestas', 'encuestas.id', '=', 'preguntas.encuesta_id')
         ->select(DB::raw('count(valoracion) as votos, valoracion, pregunta_id'))
         ->where('respuestas.valoracion','<>','NULL')
         ->where('encuestas.id',$idEncuesta)
         ->groupBy('pregunta_id','valoracion')
         ->get();
    return $op_val = array($op,$val,$t_l);
  }

}
