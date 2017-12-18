@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear encuesta</div>

                <div class="panel-body">

                <div id="vue">
                      <div class="form-group" >
                        {!! Form::label('titulo', 'Titulo') !!}
                        {!! Form::text('titulo', null, ['class' => 'form-control', 'required', 'v-model'=> 'titulo']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('descripcion', 'Descripcion') !!}
                        {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'required', 'v-model'=> 'descripcion']) }}
                      </div>

                      <div class="form-group">
                        {!! Form::label('ambito', 'Ambito') !!}
                        {!! Form::select('ambito', ['user1' => 'tipo usuario 1', 'user2' => 'tipo usuario 2', 'user3' => 'tipo usuario 3'], null, ['class' => 'form-control', 'required', 'v-model'=> 'ambito']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                        {!! Form::date('fecha_inicio', null,  ['class' => 'form-control', 'required', 'v-model'=> 'fecha_inicio']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                        {!! Form::date('fecha_fin', null,  ['class' => 'form-control', 'required' , 'v-model'=> 'fecha_fin']) !!}
                      </div>

                      <button class="btn btn-primary pull-right"  v-on:click="add()">Guardar</button>

                  </div>
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
        titulo: '',
        descripcion: '',
        ambito: '',
        fecha_inicio: '',
        fecha_fin: '',
    },

    methods: {
        add() {
            axios.post('/api/encuestas', {
                titulo: this.titulo,
                descripcion: this.descripcion,
                ambito: this.ambito,
                fecha_inicio: this.fecha_inicio,
                fecha_fin: this.fecha_fin
            }).then(response => {
                location.replace(`/encuesta-creada/`+response.data.id);
            });

        }
    }
});
</script>
@endsection
