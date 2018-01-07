<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {

            //atributos de la tabla preguntas
            $table->increments('id');
            $table->string('pregunta');
            $table->text('aclaratoria');
            $table->string('tipo_respuesta');
            $table->integer('valoracion_min')->nullable();
            $table->integer('valoracion_max')->nullable();
            $table->string('etiqueta_min')->nullable();
            $table->string('etiqueta_max')->nullable();
            $table->timestamps();

            //id_encuesta clave foranea de la tabla encuestas,
            //actualizar y eliminar en cascada
            $table->integer('encuesta_id')->unsigned();
            $table->foreign('encuesta_id')
            ->references('id')->on('encuestas')
            ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}
