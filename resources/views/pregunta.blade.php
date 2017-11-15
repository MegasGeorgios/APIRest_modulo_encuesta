@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Agregar pregunta
                </div>

                <div class="panel-body">

                  <form method="post" action="/api/encuesta/{{$idEncuesta}}/preguntas">
                        <div class="form-group">
                          {!! Form::label('pregunta', 'Pregunta') !!}
                          {!! Form::text('pregunta', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                      <div class="form-group">
                        {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                        {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('tipo_respuesta', 'Tipo de respuesta') !!}
                        {!! Form::select('tipo_respuesta', ['texto-libre' => 'Texto libre', 'valoracion' => 'Valoracion', 'opciones' => 'Opciones'], null, ['class' => 'form-control', 'required']) !!}
                      </div>



                      {!! Form::submit('Agregar', ['class' => 'btn btn-primary pull-right']) !!}

                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
