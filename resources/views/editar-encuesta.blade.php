@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar encuesta
                    <a class="pull-right" href="{{url('api/encuesta/1/preguntas')}}">Editar preguntas</a>
                </div>

                <div class="panel-body">

                {!!  Form::open(['url' => 'api/encuestas/1', 'method' => 'POST']) !!}
                {{ method_field('PUT') }}
                      <div class="form-group">
                        {!! Form::label('titulo', 'Titulo') !!}
                        {!! Form::text('titulo', null, ['class' => 'form-control', 'required']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('descripcion', 'Descripcion') !!}
                        {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'required']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('ambito', 'Ambito') !!}
                        {!! Form::select('ambito', ['1' => 'tipo usuario 1', '2' => 'tipo usuario 2', '3' => 'tipo usuario 3'], null, ['class' => 'form-control', 'required']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                        {!! Form::date('fecha_inicio', null,  ['class' => 'form-control', 'required']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                        {!! Form::date('fecha_fin', null,  ['class' => 'form-control']) !!}
                      </div>

                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}

                  {!! Form::close() !!}

                  <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Pregunta</th>
                              <th scope="col">aclaratoria</th>
                              <th scope="col">Tipo respuesta</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="encuesta in encuestas">
                              <td>@{{ encuesta.Pregunta }}</td>
                              <td>@{{ encuesta.aclaratoria }}</td>
                              <td>@{{ encuesta.tipo_respuesta }}</td>
                              <td>tipo usuario</td>
                              <td>
                                <a :href="'"><i ></i>editar</a>-
                                <a :href=""><i class="fa fa-trash-o"></i></a>
                              </td>

                            </tr>
                          </tbody>
                        </table>
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
		encuestas: [],
		errors: []
  },
	created: function() {
    axios.get(`/api/encuesta/'+encuesta.id`)
    .then(response => {
      this.encuestas = response.data.datos;
    })
    .catch(e => {
      this.errors.push(e);
    });
  }
})
</script>
@endsection
