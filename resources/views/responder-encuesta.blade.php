@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div id="vue">

                        <div class="panel-body"  >
                          <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                              <h1 class="display-3">@{{ encuesta.titulo }}</h1>
                              <p class="lead">@{{ encuesta.descripcion }}</p>
                            </div>
                          </div>


                              <form >
                              <div v-for="pregunta in encuesta.preguntas">

                                <div v-if="pregunta.tipo_respuesta === 'opciones'">
                                  <p class="h3">@{{ pregunta.pregunta }}</p>
                                  <small class="text-muted">
                                    @{{ pregunta.aclaratoria }}
                                  </small>
                                  <ul class="list-group">
                                    <li class="list-group-item"><input type="checkbox" > Dapibus ac facilisis in</li>
                                    <li class="list-group-item"><input type="checkbox" > Morbi leo risus</li>
                                    <li class="list-group-item"><input type="checkbox" > Porta ac consectetur ac</li>
                                    <li class="list-group-item"><input type="checkbox" > Vestibulum at eros</li>
                                  </ul>
                                </div>

                                <div  v-if="pregunta.tipo_respuesta === 'valoracion'">
                                  <p class="h3">@{{ pregunta.pregunta }}</p>
                                  <small class="text-muted">
                                    @{{ pregunta.aclaratoria }}
                                  </small>
                                  <ul class="list-group">
                                    <li class="list-group-item"><font size="5px"> 1 </font>  <input type="checkbox" ></li>
                                    <li class="list-group-item"><font size="5px"> 2 </font>  <input type="checkbox" ></li>
                                    <li class="list-group-item"><font size="5px"> 3 </font>  <input type="checkbox" ></li>
                                    <li class="list-group-item"><font size="5px"> 4 </font>  <input type="checkbox" ></li>
                                    <li class="list-group-item"><font size="5px"> 5 </font>  <input type="checkbox" ></li>
                                  </ul>
                                </div>

                                <div v-if="pregunta.tipo_respuesta === 'texto-libre'">
                                  <p class="h3">@{{ pregunta.pregunta }}</p>
                                  <small class="text-muted">
                                    @{{ pregunta.aclaratoria }}
                                  </small>
                                  <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
                                </div>

                              </div>

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
