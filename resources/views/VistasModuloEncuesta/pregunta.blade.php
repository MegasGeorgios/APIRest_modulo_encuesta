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

                  <div id="vue" >
                        <div class="form-group">
                          {!! Form::label('pregunta', 'Pregunta') !!}
                          {!! Form::text('pregunta', null, ['class' => 'form-control', 'required', 'v-model'=> 'pregunta']) !!}
                        </div>

                      <div class="form-group">
                        {!! Form::label('aclaratoria', 'Aclaratoria') !!}
                        {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'required', 'v-model'=> 'aclaratoria']) }}
                      </div>

                      <div class="form-group" >
                        {!! Form::label('tipo_respuesta', 'Tipo de respuesta') !!}
                        <select id="combito" name="tipo_respuesta" v-model="tipo_respuesta" class="form-control" required>
                          <option value="texto-libre">Texto libre</option>
                          <option value="valoracion">Valoracion</option>
                          <option value="opciones">Opciones</option>
                        </select>
                      </div>

                      <div id="div_valoracion" class="contenido row">
                        <div class="col-md-6" >
                          <input class="form-control " type="number" name="valoracion_min" v-model="valoracion_min" placeholder="valoracion minima">
                        </div>
                        <div class="col-md-6" >
                          <input class="form-control " type="number" name="valoracion_max" v-model="valoracion_max" placeholder="valoracion maxima">
                        </div>
                      </div><br>


                      <a type="button" class="btn btn-primary pull-left" href="/encuesta/{{$idEncuesta}}/preguntas">Ir al panel de la encuesta</a> <button class="btn btn-primary pull-right"  v-on:click="add()">Agregar</button>
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
        pregunta: '',
        aclaratoria: '',
        tipo_respuesta: '',
        valoracion_min: '',
        valoracion_max: '',
    },

    methods: {
        add() {
            var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
            axios.post(`/api/encuesta/${idEncuesta}/preguntas`, {
                pregunta: this.pregunta,
                aclaratoria: this.aclaratoria,
                tipo_respuesta: this.tipo_respuesta,
                valoracion_min: this.valoracion_min,
                valoracion_max: this.valoracion_max
            }).then(response => {
                alert(response.data.mensaje);
                window.location.reload();
            });

        }
    }
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
        $(".contenido").hide();
        $("#combito").change(function(){
        $(".contenido").hide();
            $("#div_" + $(this).val()).show();
        });
    });
</script>
@endsection
