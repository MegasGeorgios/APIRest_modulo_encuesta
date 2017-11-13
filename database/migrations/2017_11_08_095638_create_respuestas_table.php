<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {

            //atributos de la tabla respuestas
            $table->increments('id');
            $table->text('texto_libre')->nullable();
            $table->integer('valoracion')->nullable();
            $table->string('opciones')->nullable();
            $table->timestamps();

            //id_pregunta clave foranea de la tabla preguntas,
            //actualizar y eliminar en cascada
            $table->integer('pregunta_id')->unsigned();
            $table->foreign('pregunta_id')
            ->references('id')->on('preguntas')
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
        Schema::dropIfExists('respuestas');
    }
}
