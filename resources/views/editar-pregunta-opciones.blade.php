@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Editar pregunta </div>

              <div class="panel-body"  id="vue">

              <form method="POST" action="/act-pregunta-opciones/{{$idPregunta}}">
              {!! method_field('PUT') !!}

              <div class="form-group">
                {!! Form::label('pregunta', 'Pregunta') !!}
                {!! Form::text('pregunta', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.pregunta']) !!}
              </div>

              <div class="form-group">
                {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'encuesta.aclaratoria']) }}
              </div>

              <div class="form-group" v-for="pregunta in encuesta.op">
                  {!! Form::label('opciones[]', 'Opcion') !!}
                  <input type="hidden" name="id_op[]" :value="pregunta.id">
                  {!! Form::text('opciones[]', null, ['class' => 'form-control', 'required', 'v-bind:value' => 'pregunta.opcion']) !!}
                  <a :href="`/eliminar-opcion/${pregunta.id}`"><i class="fa fa-trash-o pull-right"></i></a>
              </div><br>


              {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}

            {!! Form::close() !!}

            <form method="POST" action="/api/pregunta/{{$idPregunta}}/opciones">
              <br><br><br><br>

              <label for="opcion"> Opciones</label>
              <div class="field_wrapper form-group">
                  <div>
                    <input class="form-control" type="text" name="opciones[]" value=""/>
                    <br>
                  </div>
              </div>

              <br><br><a href="javascript:void(0);" class="add_button pull-left" title="Add field">Otra opcion</a>
              {!! Form::submit('Agregar', ['class' => 'btn btn-primary pull-right']) !!}

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
    encuesta: {},
		errors: []
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
  }
})
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input class=" form-control " type="text" name="opciones[]" value=""/><a href="javascript:void(0);" class="remove_button pull-right" title="Remove field"><i class="fa fa-trash-o"></i></a></div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
@endsection
