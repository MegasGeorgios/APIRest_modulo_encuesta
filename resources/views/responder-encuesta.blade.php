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

                         

                          <div v-for="(pregunta, index) in encuesta.preguntas">
                            <div v-if="pregunta.tipo_respuesta === 'opciones'">
                              <p class="h3">@{{ pregunta.pregunta }}</p>
                              <small class="text-muted">
                                @{{ pregunta.aclaratoria }}
                              </small>
                              <select v-model="respuestas[index].respuesta">
                                <option v-for="opcion in pregunta.op">@{{ opcion.opcion }}</option>
                              </select>
                            </div>
                         
                            <div  v-if="pregunta.tipo_respuesta === 'valoracion'">
                              <p class="h3">@{{ pregunta.pregunta }}</p>
                              <small class="text-muted">
                                @{{ pregunta.aclaratoria }}
                              </small>
                              <select v-model="respuestas[index].respuesta">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>

                            <div v-if="pregunta.tipo_respuesta === 'texto-libre'">
                              <p class="h3">@{{ pregunta.pregunta }}</p>
                              <small class="text-muted">
                                @{{ pregunta.aclaratoria }}
                              </small>
                              <div class="form-group">
                                <textarea v-model="respuestas[index].respuesta" class="form-control"  rows="3" required></textarea>
                              </div>
                            </div>
                           
                          </div>

                          <button class="btn btn-primary pull-right"  v-on:click="add()">Guardar</button>
                        

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
    encuesta: [],
    respuestas: [],
		errors: []
  },
	created: function() {
    var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
    axios.get(`/api/rpd_encuesta/${idEncuesta}`)
    .then(response => {
      this.encuesta = response.data.datos[0];
      for (var index = 0; index < this.encuesta.preguntas.length; index++) {
        this.respuestas.push({
          id: this.encuesta.preguntas[index].id, 
          tipo_respuesta:  this.encuesta.preguntas[index].tipo_respuesta,
          respuesta: ''
        });
      }
    })
    .catch(e => {
      this.errors.push(e);
    });
  },

  methods: {
      add() {
          
          axios.post('/rpd_encuesta', this.respuestas).then( function() {
              location.replace("/");
          });

      }
  }
})
</script>


@endsection
