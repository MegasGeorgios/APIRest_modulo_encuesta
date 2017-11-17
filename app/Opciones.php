<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opciones extends Model
{

  protected $table = 'opciones';

  protected $fillable = ['opcion'];

  public function pregunta()
  {
    // 1 pregunta pertenece a una encuesta
    return $this->belongsTo('App\Pregunta', 'pregunta_id');
  }
}
