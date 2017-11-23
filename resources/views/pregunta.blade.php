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

                  <form id="vue" >
                        <div class="form-group" method="post">
                          {!! Form::label('pregunta', 'Pregunta') !!}
                          {!! Form::text('pregunta', null, ['class' => 'form-control', 'required', 'v-model'=> 'pregunta']) !!}
                        </div>

                      <div class="form-group">
                        {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                        {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required', 'v-model'=> 'aclaratoria']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('tipo_respuesta', 'Tipo de respuesta') !!}
                        {!! Form::select('tipo_respuesta', ['texto-libre' => 'Texto libre', 'valoracion' => 'Valoracion', 'opciones' => 'Opciones'], null, ['class' => 'form-control', 'required', 'v-model'=> 'tipo_respuesta']) !!}
                      </div>


                      <a type="button" class="btn btn-primary pull-left" href="/encuesta/{{$idEncuesta}}/preguntas">Ir a panel de encuesta</a> <button class="btn btn-primary pull-right"  v-on:click="add()">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
new Vue({
el: '#vue',
    data: {
        pregunta: '',
        aclaratoria: '',
        tipo_respuesta: '',
    },

    methods: {
        add() {
            var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
            axios.post(`/api/encuesta/${idEncuesta}/preguntas`, {
                pregunta: this.pregunta,
                aclaratoria: this.aclaratoria,
                tipo_respuesta: this.tipo_respuesta
            }).then(response => {
                window.location.reload();
            });

        }
    }
});
</script>
@endsection
