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
                              <div class="card" >
                                <ul class="list-group list-group-flush" >
                                  <li class="list-group-item" v-for="opcion in pregunta.op">
                                    <input v-model="respuestas[index].respuesta"  :value="opcion.opcion " type="radio">
                                    <font size="4px">@{{ opcion.opcion }}</font>
                                  </li>
                                </ul>
                              </div>
                            </div>

                            <div  v-if="pregunta.tipo_respuesta === 'valoracion'">
                              <p class="h3">@{{ pregunta.pregunta }}</p>
                              <small class="text-muted">
                                @{{ pregunta.aclaratoria }}
                              </small>
                              <div class="card" >
                                <ul class="list-group list-group-flush" >
                                  <li style="display:inline;" class="list-group-item"  v-for="value in range(pregunta.valoracion_min, pregunta.valoracion_max)" >
                                    <input v-model="respuestas[index].respuesta" :value="value" type="radio">

                                      <font size="4px" v-if="pregunta.valoracion_min == value">
                                        @{{ value}} <font size="1px">@{{ pregunta.etiqueta_min}}</font>
                                      </font>

                                      <font v-else>
                                      <font size="4px" v-if="pregunta.valoracion_max == value">
                                        @{{ value}} <font size="1px">@{{ pregunta.etiqueta_max}}</font>
                                      </font>

                                      <font size="4px" v-else>
                                        @{{ value}}
                                      </font>
                                      </font>
                                  </li>
                                </ul>
                              </div>
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
          pregunta_id: this.encuesta.preguntas[index].id,
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
          var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
          let res = {
            id_preg_texto_libre: [],
            texto_libre: [],
            id_preg_valoracio: [],
            val: [],
            id_preg_opciones: [],
            opciones: []
          };

          for(respuesta of this.respuestas) {
            if (respuesta.tipo_respuesta === 'texto-libre') {
              res.id_preg_texto_libre.push(respuesta.pregunta_id);
              res.texto_libre.push(respuesta.respuesta);
            }
            else if (respuesta.tipo_respuesta === 'opciones') {
              res.id_preg_opciones.push(respuesta.pregunta_id);
              res.opciones.push(respuesta.respuesta);
            } else {
              res.id_preg_valoracio.push(respuesta.pregunta_id);
              res.val.push(respuesta.respuesta);
            }
          }

          axios.post(`/api/rpd_encuesta/${idEncuesta}`, res).then( function(response) {
             location.replace("/encuestas");
          });

      },
      range(start, end) {
          return Array(end - start + 1).fill().map((_, idx) => start + idx)
      }
  }
})
</script>


@endsection
