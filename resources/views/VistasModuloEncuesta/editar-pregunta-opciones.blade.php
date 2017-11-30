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

              <div class="form-group" v-for="pregunta in encuesta.op">
                  <label for="opciones[]">Opcion</label>
                  <input  type="text" name="opciones[]" class="form-control" v-model="pregunta.opcion" title="Para modificar, elimina y crea una nueva!" disabled>
                  <a href="" v-on:click="borrarOpcion(pregunta)"><i class="fa fa-trash-o pull-right" title="Eliminar opción"></i></a>
              </div><br>


              {!! Form::button('Guardar', ['class' => 'btn btn-primary pull-right', 'v-on:click' => 'putPregunta()']) !!}

            {!! Form::close() !!}

            <form>
              <br><br><br><br>

              <label for="opcion"> Agrergar nueva opcion</label>
              <div class="field_wrapper form-group">
                  <div>
                    <input class="form-control" type="text" v-model="opcion" />
                    <br>
                  </div>
              </div>

              <a type="button" class="btn btn-primary pull-left" :href="'/encuesta/'+encuesta.encuesta_id+'/preguntas'">Ir al panel de la encuesta</a>
              {!! Form::button('Agregar', ['class' => 'btn btn-primary pull-right', 'v-on:click' => 'addOpcion()']) !!}

            {!! Form::close() !!}

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
    encuesta: [],
	errors: [],
    opcion: ''
  },
	created: function() {
    var idPregunta = JSON.parse(<?php echo json_encode($idPregunta); ?>);
    axios.get(`/api/pregunta/${idPregunta}/opciones`)
    .then(response => {
      this.encuesta = response.data.datos;
    })
    .catch(e => {
      this.errors.push(e);
    });
  },
  methods: {
      addOpcion() {
        var idPregunta = JSON.parse(<?php echo json_encode($idPregunta); ?>);
        //console.log(idPregunta);
        //console.log(this.opcion);
        axios.post(`/api/pregunta/${idPregunta}/opciones`, {opciones: this.opcion})
        .then(response => {
            location.reload();
        })
      },
      putPregunta() {
        var idPregunta = JSON.parse(<?php echo json_encode($idPregunta); ?>);
        console.log(idPregunta);
        console.log(this.encuesta);

        this.encuesta.id_op = [];
        for (opcion of this.encuesta.op) {
            this.encuesta.id_op.push(opcion.id)
        }

        //alert(JSON.stringify(this.encuesta));
        axios.put(`/act-pregunta-opciones/${idPregunta}`, this.encuesta)
        .then(response => {
            location.reload();
        })
      },
      borrarOpcion(pr){
      axios.delete(`/eliminar-opcion/`+pr.id)
      .then(response => {
        //alert('Encuesta eliminada');
        location.reload();
      });
    }
  }
})
</script>

@endsection
