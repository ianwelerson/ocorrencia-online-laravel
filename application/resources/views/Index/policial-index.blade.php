@extends('Auxiliar/Layout/Model/policial-model')

  @section('navegador-title', 'Ocorrencia Online')

  @section('page-title', 'Ocorrencia Online')

  @section('content')

    <div class="row full-screen index-app">
      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/policial/lista-usuarios')}}"><i class="material-icons right">wc</i>Lista de Usuario</a>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/policial/lista-ocorrencias')}}"><i class="material-icons right">chat</i>Lista Ocorrências</a>
        </div>
      </div>

    </div>

  @endsection
