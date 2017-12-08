<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="getEncuesta">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>{{ config('app.name', 'Encuestas') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>


                </div>
            </div>
        </nav>
<div class="container">
    <div class="row">
				<div class="col-md-8 col-md-offset-2" id="vue">
            <div class="panel panel-default">
              <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Titulo</th>
                          <th scope="col">Fecha inicio</th>
                          <th scope="col">Fecha fin</th>
                          <th scope="col">Opcion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="encuesta in encuestas">
                          <th scope="row">@{{ encuesta.id }}</th>
                          <td>@{{ encuesta.titulo }}</td>
                          <td>@{{ encuesta.fecha_inicio }}</td>
                          <td>@{{ encuesta.fecha_fin }}</td>
                          <td>
                            <a  v-on:click="responderEncuesta(encuesta)"><i class="fa fa-eye" title="Llenar encuesta"></i></a>-
                            <a :href="'/resultados/encuesta/'+encuesta.id"><i class="fa fa-bar-chart" title="Ver resultados"></i></a>-
                            <a :href="'/encuesta/'+encuesta.id+'/preguntas'"><i class="fa fa-edit" title="Agregar preguntas, editar encuesta"></i></a>-
                            <a  href="" v-on:click="borrarEncuesta(encuesta)"><i class="fa fa-trash-o" title="Eliminar encuesta"></i></a>
                          </td>

                        </tr>
                      </tbody>
                    </table>
                    <a href="{{url('/encuesta')}}" class="btn btn-primary pull-right">Crear encuesta</a>
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
		encuestas: [],
		errors: []
  },
	created: function() {
    axios.get(`/api/encuestas`)
    .then(response => {
      this.encuestas = response.data.datos;
    })
    .catch(e => {
      this.errors.push(e);
    })
  },

  methods:{
    borrarEncuesta(encuesta){
      axios.delete(`/eliminar-encuesta/`+encuesta.id)
      .then(response => {
        //alert('Encuesta eliminada');
        location.reload();
      });

    },
    responderEncuesta(enc){
      axios.get(`/api/encuestas/`+enc.id)
      .then(response => {

          alert('No posees los permisos para esta accion!')
          location.reload();

      });

    }
  }
});
</script>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
