<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
  protected $table = 'encuestas';

  protected $fillable = [
      'titulo', 'descripcion','fecha_inicio', 'fecha_fin', 'ambito'
  ];

  public function preguntas()
	{
		// 1 encuesta tiene muchas preguntas
		return $this->hasMany('App\Pregunta', 'encuesta_id', 'id');
	}

}
