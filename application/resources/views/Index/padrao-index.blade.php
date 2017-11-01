@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Ocorrencia Online')

  @section('page-title', 'Ocorrencia Online')

  @section('content')

    <div class="row full-screen index-app">
      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/mapa')}}"><i class="material-icons right">map</i>Mapa do Crime</a>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{($isLogged == true) ? url('/ocorrencia/registrar') : url('/ocorrencia') }}"><i class="material-icons right">add_circle_outline</i>Registrar Ocorrencia</a>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/meu-cadastro')}}"><i class="material-icons right">perm_identity</i>Meu Cadastro</a>
        </div>
      </div>
    </div>

  @endsection
