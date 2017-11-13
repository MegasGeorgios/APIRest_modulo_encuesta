<!DOCTYPE html>
<html  ng-app="getEncuesta">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {!! Html::style('css/app.css') !!}
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
        <div class="col-md-8 col-md-offset-2">
          <div ng-controller="EncuestaController">
          <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Titulo</th>
                      <th scope="col">Fecha inicio</th>
                      <th scope="col">Fecha fin</th>
                      <th scope="col">
                        <button id="btn-id" class="btn btn-succes btn-xs"></button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="encuesta in encuestas">
                      <th scope="row">@{{ encuesta.id }}</th>
                      <td>@{{ encuesta.titulo }}</td>
                      <td>@{{ encuesta.fecha_inicio }}</td>
                      <td>@{{ encuesta.fecha_fin }}</td>
                      <td>
                        <button id="btn-id" class="btn btn-warning btn-xs btn-detail" ng-click=""></button>
                      </todo>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('angular/app.js')}}"></script>
<script src="{{asset('angular/controllers/EncuestaController.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.js"></script>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
