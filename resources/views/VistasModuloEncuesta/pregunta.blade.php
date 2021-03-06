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
                        {{ Form::textarea('aclaratoria', null, ['class' => 'form-control', 'v-model'=> 'aclaratoria']) }}
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
                        <div class="col-md-2" >
                          <input class="form-control " type="number" name="valoracion_min" v-model="valoracion_min" placeholder="minimo">
                        </div>
                        <div class="col-md-4" >
                          <input class="form-control " type="text" name="etiqueta_min" v-model="etiqueta_min" placeholder="Etiqueta del valor minimo">
                        </div>
                        <div class="col-md-2" >
                          <input class="form-control " type="number" name="valoracion_max" v-model="valoracion_max" placeholder="maximo">
                        </div>
                        <div class="col-md-4" >
                          <input class="form-control " type="text" name="etiqueta_max" v-model="etiqueta_max" placeholder="Etiqueta del valor maximo">
                        </div>

                      </div><br>

                      <div >
                        <button class="btn btn-primary pull-left" v-on:click="nueva()">Guardar y añadir nueva</button>
                        <button class="btn btn-primary pull-right"  v-on:click="add()">Guardar</button>
                      </div>

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
        etiqueta_min: '',
        etiqueta_max: ''
    },

    methods: {
        nueva() {
            var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
            axios.post(`/api/encuesta/${idEncuesta}/preguntas`, {
                pregunta: this.pregunta,
                aclaratoria: this.aclaratoria,
                tipo_respuesta: this.tipo_respuesta,
                valoracion_min: this.valoracion_min,
                valoracion_max: this.valoracion_max,
                etiqueta_min: this.etiqueta_min,
                etiqueta_max: this.etiqueta_max
            }).then(response => {
                alert(response.data.mensaje);
                window.location.reload();
            });

        },

        add() {
            var idEncuesta = JSON.parse(<?php echo json_encode($idEncuesta); ?>);
            axios.post(`/api/encuesta/${idEncuesta}/preguntas`, {
                pregunta: this.pregunta,
                aclaratoria: this.aclaratoria,
                tipo_respuesta: this.tipo_respuesta,
                valoracion_min: this.valoracion_min,
                valoracion_max: this.valoracion_max,
                etiqueta_min: this.etiqueta_min,
                etiqueta_max: this.etiqueta_max
            }).then(response => {
                location.replace(`/edit-encuesta/${idEncuesta}`);
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
