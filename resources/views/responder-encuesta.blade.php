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

                          <form method="post" action="{{url('/rpd_encuesta')}}">

                          <div v-for="pregunta in encuesta.preguntas">
                            <div v-if="pregunta.tipo_respuesta === 'opciones'">
                              <p class="h3">@{{ pregunta.pregunta }}</p>
                              <small class="text-muted">
                                @{{ pregunta.aclaratoria }}
                              </small>
                              <input type="hidden" name="id_preg_opciones[]" :value="pregunta.id">
                              <div v-for="opcion in pregunta.op">
                                <ul class="list-group" >
                                  <li class="list-group-item"><input name="opciones[]" :value="opcion.opcion" type="checkbox" >@{{opcion.opcion}}</li>
                                </ul>
                              </div>
                            </div>

                            <div  v-if="pregunta.tipo_respuesta === 'valoracion'">
                              <p class="h3">@{{ pregunta.pregunta }}</p>
                              <small class="text-muted">
                                @{{ pregunta.aclaratoria }}
                              </small>
                              <ul class="list-group">
                                <input type="hidden" name="id_preg_valoracion[]" :value="pregunta.id">
                                <li class="list-group-item"><font size="5px"> 1 </font>  <input name="val[]" value="1" type="checkbox" ></li>
                                <li class="list-group-item"><font size="5px"> 2 </font>  <input name="val[]" value="2" type="checkbox" ></li>
                                <li class="list-group-item"><font size="5px"> 3 </font>  <input name="val[]" value="3" type="checkbox" ></li>
                                <li class="list-group-item"><font size="5px"> 4 </font>  <input name="val[]" value="4" type="checkbox" ></li>
                                <li class="list-group-item"><font size="5px"> 5 </font>  <input name="val[]" value="5" type="checkbox" ></li>
                              </ul>
                            </div>

                            <div v-if="pregunta.tipo_respuesta === 'texto-libre'">
                              <p class="h3">@{{ pregunta.pregunta }}</p>
                              <small class="text-muted">
                                @{{ pregunta.aclaratoria }}
                              </small>
                              <div class="form-group">
                                <input type="hidden" name="id_preg_texto_libre[]" :value="pregunta.id">
                                <textarea name="texto_libre[]" class="form-control"  rows="3" required></textarea>
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
    axios.get(`/api/rpd_encuesta/${idEncuesta}`)
    .then(response => {
      this.encuesta = response.data.datos[0];
    })
    .catch(e => {
      this.errors.push(e);
    });
  }
})
</script>


@endsection
