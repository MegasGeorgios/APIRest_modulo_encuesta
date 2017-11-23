@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Editar pregunta </div>

              <div class="panel-body"  id="vue">

              <form>


                      <div class="form-group">
                        {!! Form::label('pregunta', 'Pregunta') !!}
                        {!! Form::text('pregunta', null, ['class' => 'form-control', 'required', 'v-model' => 'encuesta.pregunta']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                        {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required', 'v-model' => 'encuesta.aclaratoria']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('tipo_respuesta', 'Tipo de respuesta') !!}
                        {!! Form::select('tipo_respuesta', ['texto-libre' => 'Texto libre', 'valoracion' => 'Valoracion', 'opciones' => 'Opciones'], null, ['class' => 'form-control', 'required', 'v-model' => 'encuesta.tipo_respuesta']) !!}
                      </div>

                      <a type="button" class="btn btn-primary pull-left" :href="'/encuesta/'+encuesta.encuesta_id+'/preguntas'">Ir al panel de la encuesta</a>
            {!! Form::button('Guardar', ['class' => 'btn btn-primary pull-right', 'v-on:click' => 'enviar()']) !!}
            </form>
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
  var idPregunta = JSON.parse(<?php echo json_encode($idPregunta); ?>);
  axios.get(`/api/preguntas/${idPregunta}`)
  .then(response => {
    this.encuesta = response.data.datos;
  })
  .catch(e => {
    this.errors.push(e);
  });
},
methods:{
    enviar(){
      axios.put(`/api/preguntas/${this.encuesta.id}`, this.encuesta)
      .then(response => {
        //alert(JSON.stringify(response));
        location.reload();
      });
    }
  }
})
</script>
@endsection
