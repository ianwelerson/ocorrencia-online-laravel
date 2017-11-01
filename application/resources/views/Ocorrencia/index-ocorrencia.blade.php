@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Ocorrencia Online')

  @section('page-title', 'Ocorrencia Online')

  @section('content')

    <div class="row full-screen index-app">
      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/registrar')}}"><i class="material-icons right">add_circle</i>Não tenho cadastro</a>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/acessar')}}"><i class="material-icons right">send</i>Tenho cadastro</a>
        </div>
      </div>
    </div>

  @endsection
