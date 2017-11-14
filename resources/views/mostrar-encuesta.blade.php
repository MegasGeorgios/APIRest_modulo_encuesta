@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar encuesta
                    <a class="pull-right" href="{{url('api/encuesta/1/preguntas')}}">Editar preguntas</a>
                </div>

                <div class="panel-body">

                {!!  Form::open(['url' => 'api/encuestas/1', 'method' => 'POST']) !!}
                {{ method_field('PUT') }}
                      <div class="form-group">
                        {!! Form::label('titulo', 'Titulo') !!}
                        {!! Form::text('titulo', null, ['class' => 'form-control', 'required']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('descripcion', 'Descripcion') !!}
                        {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'required']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('ambito', 'Ambito') !!}
                        {!! Form::select('ambito', ['1' => 'tipo usuario 1', '2' => 'tipo usuario 2', '3' => 'tipo usuario 3'], null, ['class' => 'form-control', 'required']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                        {!! Form::date('fecha_inicio', null,  ['class' => 'form-control', 'required']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                        {!! Form::date('fecha_fin', null,  ['class' => 'form-control']) !!}
                      </div>

                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}

                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
