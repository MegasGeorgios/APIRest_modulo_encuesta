<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
  protected $table = 'respuestas';

  protected $fillable = [
      'texto_libre', 'valoracion', 'opciones'
  ];

  public function pregunta()
  {
    // 1 respuesta pertenece a una pregunta
    return $this->belongsTo('App\Pregunta');
  }

}
