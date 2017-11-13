@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Agregar pregunta </div>

                <div class="panel-body">

                  {!!  Form::open(['url' => 'api/encuesta/1/preguntas', 'method' => 'post']) !!}
                        <div class="form-group">
                          {!! Form::label('pregunta', 'Pregunta') !!}
                          {!! Form::text('pregunta', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                      <div class="form-group">
                        {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                        {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required']) }}
                      </div>

                      <div class="form-group">
                        <label for="tipo_respuesta"> Tipo de respuesta</label>
                        <select id="tipo_respuesta" class="form-control" name="tipo_respuesta" required>
                          <option value="1"> Texto libre </option>
                          <option value="2"> Valoracion </option>
                          <option value="3"> Opciones </option>
                        </select>
                      </div>

                      

                      {!! Form::submit('Agregar', ['class' => 'btn btn-primary pull-right']) !!}

                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
