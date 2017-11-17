<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
  protected $table = 'preguntas';

  protected $fillable = [
      'pregunta', 'aclaratoria', 'tipo_respuesta'
  ];

  public function encuesta()
  {
    // 1 pregunta pertenece a una encuesta
    return $this->belongsTo('App\Encuesta');
  }

  public function op()
	{
		// 1 pregunta tiene varias respuestas
		return $this->hasMany('App\Opciones', 'pregunta_id', 'id');
	}
}
