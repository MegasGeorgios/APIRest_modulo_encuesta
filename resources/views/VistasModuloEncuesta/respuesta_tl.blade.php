@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div id="vue">
                  <div class="panel-heading" ><h3>Respuestas: </h3></div>

                <div class="panel-body"  >
                  <div class="form-group" v-for="t_l in texto_libre">
                    <textarea  class="form-control"  rows="3" disabled>@{{ t_l.texto_libre}}</textarea>
                  </div>

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
    texto_libre: [],
    valoracion: [],
    opciones: [],
		errors: []
  },
	created: function() {
    var idPregunta = JSON.parse(<?php echo json_encode($idPregunta); ?>);
    axios.get(`/api/pregunta/${idPregunta}/respuestas`)
    .then(response => {
      this.texto_libre = response.data.texto_libre;
    })
    .catch(e => {
      this.errors.push(e);
    });
  }
})
</script>
@endsection
