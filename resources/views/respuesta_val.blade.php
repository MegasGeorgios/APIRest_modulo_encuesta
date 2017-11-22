@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div id="vue">
                  <div class="panel-heading" ><h3>Resultado: </h3></div>

                <div class="panel-body"  >
                  <ul class="list-group" v-for="valoracion in val">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <strong>Valoracion: </strong> @{{ valoracion.valoracion }}
                      <span class="badge badge-primary badge-pill"><font size="4px">@{{ valoracion.votos }} votos</font></span>
                    </li>
                  </ul>
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
    val: [],
		errors: []
  },
	created: function() {
    var idPregunta = JSON.parse(<?php echo json_encode($idPregunta); ?>);
    axios.get(`/api/pregunta/${idPregunta}/respuestas`)
    .then(response => {
      this.val = response.data.val;
    })
    .catch(e => {
      this.errors.push(e);
    });
  }
})
</script>
@endsection
