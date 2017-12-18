@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <pie-chart :data="[['Blueberry', 44], ['Strawberry', 23]]"></pie-chart>

              <div id="vue">
                <div class="panel-heading" ><h3>Resultados de la encuesta: @{{encuesta.titulo}}</h3> </div>
                <div class="panel-body"  >


                      <div>
                        <hr><h4><strong>Personas encuestadas: @{{ num }} </strong></h4><hr>
                      </div>


                      <div v-for="pregunta in encuesta.preguntas">
                        <!--TEXTO LIBRE -->
                        <div v-if="pregunta.tipo_respuesta === 'texto-libre'">
                          <h4>
                            <strong>@{{ pregunta.pregunta }} </strong>
                            <a :href="`/pregunta/${pregunta.id}/respuestas_tl`"><i class="fa fa-bar-chart pull-right"></i></a>
                          </h4>
                        </div>

                        <!--OPCIONES -->
                        <div v-if="pregunta.tipo_respuesta === 'opciones'">
                          <div>
                            <h4><strong>@{{ pregunta.pregunta }} </strong></h4>
                            <ul  v-for="opciones in op">
                              <li v-if="opciones.pregunta_id == pregunta.id" class="list-group-item d-flex justify-content-between align-items-center">
                                  @{{opciones.opciones}}
                                <span class="badge badge-primary badge-pill"><font size="4px">@{{ opciones.votos }} votos</font></span>
                              </li>
                            </ul>
                          </div>
                          <div >
                              <!--Cambiarlo por :data"chartDataPie"-->
                              <pie-chart :data="[['Sun', 3], ['Mon', 4], ['Tue', 2]]"></pie-chart>
                          </div>
                        </div><br>

                        <!--VALORACION-->
                        <div v-if="pregunta.tipo_respuesta === 'valoracion'">
                          <div>
                            <h4><strong>@{{ pregunta.pregunta }} </strong></h4>
                            <ul  v-for="valoracion in val">
                              <li v-if="valoracion.pregunta_id == pregunta.id" class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Valoracion: </strong> @{{ valoracion.valoracion }}
                                <span class="badge badge-primary badge-pill"><font size="4px">@{{ valoracion.votos }} votos</font></span>
                              </li>
                            </ul>
                          </div>
                          <div>
                            <!--Cambiarlo por :data"chartDataBarra"-->
                            <column-chart :data="[['Sun', 3], ['Mon', 4], ['Tue', 2]]"></column-chart>
                          </div>
                        </div><br>

                      </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<!-- Libreria axios -->
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- Librerias para las graficas -->
<script src="https://unpkg.com/chart.js@2.7.1/dist/Chart.bundle.js"></script>
<script src="https://unpkg.com/chartkick@2.2.4"></script>
<script src="https://unpkg.com/vue-chartkick@0.2.0/dist/vue-chartkick.js"></script>

<script>
	var app = new Vue({
  el: '#vue',
  data: {
    title: 'Encuestas',
    encuesta: {},
    chartDataPie: [],
    chartDataBarra: [],
		errors: [],
    num: 0
  },
	created: function() {
    var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
    axios.get(`/api/respuestas_op_val/${idEncuesta}`)
    .then(response => {
      this.encuesta = response.data.datos[0];
      this.op = response.data.op;
      this.val = response.data.val;
      this.num = response.data.totalEncuestados;

      //grafica torta
      for (var i = 0; i < this.encuesta.preguntas.length; i++) {
        for (var j = 0; j < this.op.length; j++) {
          if (this.op.pregunta_id[j] == this.encuesta.preguntas.id[i]) {
            if (this.op.opciones != 'null' || this.op.opciones != 'NULL') {
              this.chartDataPie.push(
                [
                  [
                    this.op.opciones[j],
                    this.op.votos[j]
                  ]
                ]);
              }
            }
          }
        }

        //grafica barras
        for (var x = 0; x < this.encuesta.preguntas.length; x++) {
          for (var y = 0; y < this.val.length; y++) {
            if (this.val.pregunta_id[y] == this.encuesta.preguntas.id[x]) {
              if (this.val.valoracion != 'null' || this.val.valoracion != 'NULL') {
                this.chartDataBarra.push(
                  [
                    [
                      this.val.valoracion[y],
                      this.op.votos[y]
                    ]
                  ]);
              }
            }
          }
        }
    })
    .catch(e => {
      this.errors.push(e);
    });
  }
})

</script>

@endsection
