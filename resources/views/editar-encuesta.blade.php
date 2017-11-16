@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar encuesta  </div>

                <div class="panel-body"  id="vue">

                <form method="post" action="/api/encuestas/{{$idEncuesta}}">
                {{ method_field('PUT') }}
                      <div class="form-group">
                        {!! Form::label('titulo', 'Titulo') !!}
                        {!! Form::text('titulo', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.titulo']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('descripcion', 'Descripcion') !!}
                        {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.descripcion']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('ambito', 'Ambito') !!}
                        {!! Form::select('ambito', ['user1' => 'tipo usuario 1', 'user2' => 'tipo usuario 2', 'user3' => 'tipo usuario 3'], null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.ambito']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                        {!! Form::date('fecha_inicio', null,  ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.fecha_inicio']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                        {!! Form::date('fecha_fin', null,  ['class' => 'form-control', 'v-bind:value' => 'encuesta.fecha_fin']) !!}
                      </div>

                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}

                </form>

                  <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Pregunta</th>
                              <th scope="col">Respuesta</th>
                            </tr>
                          </thead>
                          <tbody>

                            <tr v-for="pregunta in encuesta.preguntas">
                              <td>@{{ pregunta.id }}</td>
                              <td>@{{ pregunta.pregunta }}</td>
                              <td v-if="pregunta.tipo_respuesta === 'opciones'">
                                <a :href="`/opciones/`+pregunta.id"> @{{ pregunta.tipo_respuesta }}</a>
                              </td>
                              <td v-else>@{{ pregunta.tipo_respuesta }}</td>
                              <td>
                                  <div v-if="pregunta.tipo_respuesta === 'opciones'">
                                    <a :href="`/pregunta/${pregunta.id}/opciones`"><i class="fa fa-edit"></i></a>-
                                    <a :href="`/eliminar-pregunta/${pregunta.id}`"><i class="fa fa-trash-o"></i></a>
                                  </div>
                                  <div v-else>
                                    <a :href="`/pregunta/${pregunta.id}`"><i class="fa fa-edit"></i></a>-
                                    <a :href="`/eliminar-pregunta/${pregunta.id}`"><i class="fa fa-trash-o"></i></a>
                                  </div>
                              </td>

                            </tr>

                          </tbody>
                        </table>
                        <a :href="'/encuesta/'+encuesta.id+'/agregar-pregunta'" class="btn btn-primary pull-right">Agregar pregunta</a>
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
  }
})
</script>
@endsection
