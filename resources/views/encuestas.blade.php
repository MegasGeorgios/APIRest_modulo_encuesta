@extends('layouts.app') @section('content')
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
                          <th scope="col">Ambito</th>
                          <th scope="col">Opcion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="encuesta in encuestas">
                          <th scope="row">@{{ encuesta.id }}</th>
                          <td>@{{ encuesta.titulo }}</td>
                          <td>@{{ encuesta.fecha_inicio }}</td>
                          <td>@{{ encuesta.fecha_fin }}</td>
                          <td>@{{ encuesta.ambito }}</td>
                          <td>

                            <a :href="'encuesta/'+encuesta.id"><i class="fa fa-eye"></i></a>-
                            <a href=""><i class="fa fa-bar-chart"></i></a>-
                            <a :href="'encuesta/'+encuesta.id+'/preguntas'"><i class="fa fa-edit"></i></a>-
                            <a :href="'eliminar-encuesta/'+encuesta.id"><i class="fa fa-trash-o"></i></a>
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
    });
  }
})
</script>
@endsection
