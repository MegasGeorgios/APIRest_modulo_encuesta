@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Editar pregunta </div>

              <div class="panel-body"  id="vue">

              <form method="POST" action="/api/pregunta/{{$idPregunta}}/opciones">
              {!! method_field('PUT') !!}

              <div class="form-group">
                {!! Form::label('pregunta', 'Pregunta') !!}
                {!! Form::text('pregunta', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.pregunta']) !!}
              </div>

              <div class="form-group">
                {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.aclaratoria']) }}
              </div>

              <div class="form-group" v-for="pregunta in encuesta.op">
                  {!! Form::label('opciones[]', 'Opcion') !!}
                  <input type="hidden" name="id_op[]" :value="pregunta.id">
                  {!! Form::text('opciones[]', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'pregunta.opcion']) !!}
                  <a :href="`/eliminar-opcion/${pregunta.id}`"><i class="fa fa-trash-o pull-right"></i></a>
              </div><br>

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
