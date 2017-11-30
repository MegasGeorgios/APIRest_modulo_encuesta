@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div id="vue">
                <div class="panel-heading" ><h3>Resultados de la encuesta: @{{encuesta.titulo}}</h3> </div>

                <div class="panel-body"  >
            <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col"><h4><strong>Personas encuestadas: @{{ num }} </strong></h4></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr v-for="pregunta in encuesta.preguntas">
                        <td v-if="pregunta.tipo_respuesta === 'texto-libre'">
                          <h4><strong>@{{ pregunta.pregunta }} </strong></h4>
                        </td>
                        <td v-if="pregunta.tipo_respuesta === 'texto-libre'">
                          <a :href="`/pregunta/${pregunta.id}/respuestas_tl`"><i class="fa fa-bar-chart pull-right"></i></a>
                        </td>
                        <td v-if="pregunta.tipo_respuesta === 'opciones'">
                          <h4><strong>@{{ pregunta.pregunta }} </strong></h4>
                          <ul  v-for="opciones in op">
                            <li v-if="opciones.pregunta_id == pregunta.id" class="list-group-item d-flex justify-content-between align-items-center">
                                @{{opciones.opciones}}
                              <span class="badge badge-primary badge-pill"><font size="4px">@{{ opciones.votos }} votos</font></span>
                            </li>
                          </ul>
                        </td>
                        <td v-if="pregunta.tipo_respuesta === 'opciones'">
                          <a ><i ></i></a>
                        </td>
                        <td v-if="pregunta.tipo_respuesta === 'valoracion'">
                          <h4><strong>@{{ pregunta.pregunta }} </strong></h4>
                          <ul  v-for="valoracion in val">
                            <li v-if="valoracion.pregunta_id == pregunta.id" class="list-group-item d-flex justify-content-between align-items-center">
                              <strong>Valoracion: </strong> @{{ valoracion.valoracion }}
                              <span class="badge badge-primary badge-pill"><font size="4px">@{{ valoracion.votos }} votos</font></span>
                            </li>
                          </ul>
                        </td>
                        <td v-if="pregunta.tipo_respuesta === 'valoracion'">
                          <a ><i ></i></a>
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
    axios.get(`/api/respuestas_op_val/${idEncuesta}`)
    .then(response => {
      this.encuesta = response.data.datos[0];
      this.op = response.data.op;
      this.val = response.data.val;
      this.num = response.data.totalEncuestados;
    })
    .catch(e => {
      this.errors.push(e);
    });
  }
})
</script>

@endsection
