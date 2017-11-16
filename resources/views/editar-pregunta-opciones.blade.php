@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Editar pregunta </div>

              <div class="panel-body"  id="vue">

              <form method="post" action="/api/preguntas/{{$idPregunta}}/opciones">
              {{ method_field('PUT') }}

                      <div class="form-group">
                        {!! Form::label('pregunta', 'Pregunta') !!}
                        {!! Form::text('pregunta', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.titulo']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                        {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.aclaratoria']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('tipo_respuesta', 'Tipo de respuesta') !!}
                        {!! Form::select('tipo_respuesta', ['texto-libre' => 'Texto libre', 'valoracion' => 'Valoracion', 'opciones' => 'Opciones'], null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.tipo_respuesta']) !!}
                      </div>

                      <div v-for="encuesta in encuestas">
                        {!! Form::label('opcion', 'Opcion') !!}
                        {!! Form::text('opcion', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.opcion']) !!}
                      </div>


            {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}
            </form>
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
  var idPregunta = JSON.parse(<?php echo json_encode($idPregunta); ?>);
  axios.get(`/api/pregunta/${idPregunta}/opciones`)
  .then(response => {
    this.encuesta = response.data.datos;
  })
  .catch(e => {
    this.errors.push(e);
  });
}
})
</script>
@endsection
