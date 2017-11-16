@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div id="vue">

                <div class="panel-body"  >
                  <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-3">Titulo encuesta</h1>
                      <p class="lead">Descripcion encuesta descripcion encuesta descripcion encuesta
                        descripcion encuesta descripcion encuesta descripcion encuesta descripcion encuesta..</p>
                    </div>
                  </div>


                  <form >
                    <p class="h3">Preguntaaaaaaaaaaaaa??????</p>
                    <small class="text-muted">aclaratoria aclaratoria aclaratoria aclaratoria
                      aclaratoria aclaratoria aclaratoria aclaratoria aclaratoria
                    </small>
                    <ul class="list-group">
                      <li class="list-group-item"><input type="checkbox" > Dapibus ac facilisis in</li>
                      <li class="list-group-item"><input type="checkbox" > Morbi leo risus</li>
                      <li class="list-group-item"><input type="checkbox" > Porta ac consectetur ac</li>
                      <li class="list-group-item"><input type="checkbox" > Vestibulum at eros</li>
                    </ul>

                    <p class="h3">Preguntaaaaaaaaaaaaa??????</p>
                    <small class="text-muted">aclaratoria aclaratoria aclaratoria aclaratoria
                      aclaratoria aclaratoria aclaratoria aclaratoria aclaratoria
                    </small>
                    <ul class="list-group">
                      <li class="list-group-item"><font size="5px"> 1 </font>  <input type="checkbox" ></li>
                      <li class="list-group-item"><font size="5px"> 2 </font>  <input type="checkbox" ></li>
                      <li class="list-group-item"><font size="5px"> 3 </font>  <input type="checkbox" ></li>
                      <li class="list-group-item"><font size="5px"> 4 </font>  <input type="checkbox" ></li>
                      <li class="list-group-item"><font size="5px"> 5 </font>  <input type="checkbox" ></li>
                    </ul>

                    <p class="h3">Preguntaaaaaaaaaaaaa??????</p>
                    <small class="text-muted">aclaratoria aclaratoria aclaratoria aclaratoria
                      aclaratoria aclaratoria aclaratoria aclaratoria aclaratoria
                    </small>
                    <div class="form-group">
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>

                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}

                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
