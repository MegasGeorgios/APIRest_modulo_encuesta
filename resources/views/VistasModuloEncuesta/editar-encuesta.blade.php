@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar encuesta  </div>

                <div class="panel-body"  id="vue">

                <form method="post">
                    <div class="form-group">
                      {!! Form::label('titulo', 'Titulo') !!}
                      {!! Form::text('titulo', null, ['class' => 'form-control', 'required', 'v-model' => 'encuesta.titulo']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('descripcion', 'Descripcion') !!}
                      {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'required', 'v-model' => 'encuesta.descripcion']) }}
                    </div>

                    <div class="form-group">
                      {!! Form::label('ambito', 'Ambito') !!}
                      {!! Form::select('ambito', ['user1' => 'tipo usuario 1', 'user2' => 'tipo usuario 2', 'user3' => 'tipo usuario 3'], null, ['class' => 'form-control', 'required', 'v-model' => 'encuesta.ambito']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                      {!! Form::date('fecha_inicio', null,  ['class' => 'form-control', 'required', 'v-model' => 'encuesta.fecha_inicio']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                      {!! Form::date('fecha_fin', null,  ['class' => 'form-control', 'v-model' => 'encuesta.fecha_fin']) !!}
                    </div>

                    {!! Form::button('Guardar', ['class' => 'btn btn-primary pull-right', 'v-on:click' => 'enviarEncuesta()']) !!}

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
                              <td>@{{ pregunta.tipo_respuesta }}</td>
                              <td>
                                  <div v-if="pregunta.tipo_respuesta === 'opciones'">
                                    <a :href="`/pregunta/${pregunta.id}/opciones`"><i class="fa fa-edit" title="Agregar opciones, editar pregunta"></i></a>-
                                    <a href="" v-on:click="borrarPregunta(pregunta)"><i class="fa fa-trash-o" title="Eliminar pregunta"></i></a>
                                  </div>
                                  <div v-else>
                                    <a :href="`/pregunta/${pregunta.id}`"><i class="fa fa-edit" title="Editar pregunta"></i></a>-
                                    <a href="" v-on:click="borrarPregunta(pregunta)"><i class="fa fa-trash-o" title="Eliminar pregunta"></i></a>
                                  </div>
                              </td>

                            </tr>

                          </tbody>
                        </table>
                        <a type="button" class="btn btn-primary pull-left" href="{{url('/encuestas')}}">Ir al panel principal</a>
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
  },
  methods:{
    borrarPregunta(pr){
      axios.delete(`/eliminar-pregunta/`+pr.id)
      .then(response => {
        //alert('Encuesta eliminada');
        location.reload();
      });
    },

    enviarEncuesta(){
      axios.put(`/api/encuestas/${this.encuesta.id}`, this.encuesta)
      .then(response => {
        //alert(JSON.stringify(response));
        location.reload();
      });
    }
  }
})
</script>
@endsection
