@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div id="vue">
                <div class="panel-heading" ><h3>Resultados @{{encuesta.titulo}}</h3> </div>

                <div class="panel-body"  >
            <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col"><h4><strong>Preguntas de texto libre</strong></h4></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr v-for="pregunta in encuesta.preguntas">
                        <td v-if="pregunta.tipo_respuesta === 'texto-libre'">
                              @{{ pregunta.pregunta }}
                        </td>
                        <td v-if="pregunta.tipo_respuesta === 'texto-libre'">
                          <a :href="`/pregunta/${pregunta.id}/respuestas_tl`"><i class="fa fa-bar-chart pull-right"></i></a>
                        </td>

                      </tr>

                    </tbody>
                  </table>

            <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col"><h4><strong>Preguntas de valoracion</strong></h4></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr v-for="pregunta in encuesta.preguntas">
                        <td v-if="pregunta.tipo_respuesta === 'valoracion'">
                              @{{ pregunta.pregunta }}
                        </td>
                        <td v-if="pregunta.tipo_respuesta === 'valoracion'">
                          <a :href="`/pregunta/${pregunta.id}/respuestas_val`"><i class="fa fa-bar-chart pull-right"></i></a>
                        </td>

                      </tr>

                    </tbody>
                  </table>

                <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col"><h4><strong>Preguntas de opciones</strong></h4></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>

                          <tr v-for="pregunta in encuesta.preguntas">
                            <td v-if="pregunta.tipo_respuesta === 'opciones'">
                                  @{{ pregunta.pregunta }}
                            </td>
                            <td v-if="pregunta.tipo_respuesta === 'opciones'">
                              <a :href="`/pregunta/${pregunta.id}/respuestas_op`"><i class="fa fa-bar-chart pull-right"></i></a>
                            </td>

                          </tr>

                        </tbody>
                      </table>
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
