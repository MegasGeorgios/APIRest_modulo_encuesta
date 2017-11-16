@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Agregar opciones</div>

                <div class="panel-body">

                  <form method="POST" action="/api/pregunta/{{$idPregunta}}/opciones">

                  <div id="div_3" class="form-group contenido-oculto">
                    <label for="opcion"> Opciones</label><a href="javascript:void(0);" class="add_button pull-right" title="Add field">agregar</a>
                    <div class="field_wrapper">
                        <div>
                          <input type="text" name="opciones[]" value=""/>
                        </div>
                    </div>
                    </div>

                      <div class="form-group">
                        <label for="tipo_respuesta"> Tipo de respuesta</label>
                        <select id="tipo_respuesta" class="form-control" name="tipo_respuesta" disabled>
                          <option value="3" selected> Opciones </option>
                        </select>
                      </div>

                      {!! Form::submit('Agregar', ['class' => 'btn btn-primary pull-right']) !!}

                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="opciones[]" value=""/><a href="javascript:void(0);" class="remove_button pull-right" title="Remove field">eliminar</a></div>'; //New input field html
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
