@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div id="vue">
                <div class="panel-heading"  > @{{ encuesta.titulo }}  </div>

                <div class="panel-body"  >

                <form method="post" action="">

                    <p>@{{ encuesta.descripcion }}</p>

                    <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pregunta</th>
                                <th scope="col">Aclaratoria</th>
                                <th scope="col">Tipo respuesta</th>
                              </tr>
                            </thead>
                            <tbody>

                              <tr v-for="pregunta in encuesta.preguntas">
                                <td>@{{ pregunta.id }}</td>
                                <td>@{{ pregunta.pregunta }}</td>
                                <td>@{{ pregunta.aclaratoria }}</td>
                                <td>@{{ pregunta.tipo_respuesta }}</td>
                              </tr>

                            </tbody>
                          </table>

                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}

                </form>
                    </div>
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
