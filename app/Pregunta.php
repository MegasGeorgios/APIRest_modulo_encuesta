<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
  protected $table = 'preguntas';

  protected $fillable = [
      'pregunta', 'aclaratoria', 'tipo_respuesta', 'valoracion_min', 'valoracion_max'
  ];

  public function encuesta()
  {
    // 1 pregunta pertenece a una encuesta
    return $this->belongsTo('App\Encuesta', 'encuesta_id');
  }

  public function op()
	{
		// 1 pregunta tiene varias respuestas
		return $this->hasMany('App\Opciones', 'pregunta_id', 'id');
	}

  public function respuestas()
	{
		// 1 pregunta tiene varias respuestas
		return $this->hasMany('App\Respuesta', 'pregunta_id', 'id');
	}
}
