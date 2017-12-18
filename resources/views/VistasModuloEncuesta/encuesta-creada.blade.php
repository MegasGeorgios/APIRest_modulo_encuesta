@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Encuesta creada </div>

                <div class="panel-body"  id="vue">

                    <div class="form-group">
                      {!! Form::label('titulo', 'Titulo') !!}
                      {!! Form::text('titulo', null, ['class' => 'form-control', 'disabled', 'v-model' => 'encuesta.titulo']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('descripcion', 'Descripcion') !!}
                      {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'disabled', 'v-model' => 'encuesta.descripcion']) }}
                    </div>

                    <div class="form-group">
                      {!! Form::label('ambito', 'Ambito') !!}
                      {!! Form::select('ambito', ['user1' => 'tipo usuario 1', 'user2' => 'tipo usuario 2', 'user3' => 'tipo usuario 3'], null, ['class' => 'form-control', 'disabled', 'v-model' => 'encuesta.ambito']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                      {!! Form::date('fecha_inicio', null,  ['class' => 'form-control', 'disabled', 'v-model' => 'encuesta.fecha_inicio']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                      {!! Form::date('fecha_fin', null,  ['class' => 'form-control', 'disabled', 'v-model' => 'encuesta.fecha_fin']) !!}
                    </div>


                        <a type="button" class="btn btn-primary pull-right" href="/encuesta/{{$idEncuesta}}/preguntas">Editar encuesta</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
	var app = new Vue({
  el: '#vue',
  data: {
    title: 'Encuestas',
    encuesta: {},
		errors: []
  },
	created: function() {
    var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
    axios.get(`/api/encuesta/${idEncuesta}/preguntas`)
    .then(response => {
      this.encuesta = response.data.datos;
    })
    .catch(e => {
      this.errors.push(e);
    });
  },

})
</script>
@endsection
