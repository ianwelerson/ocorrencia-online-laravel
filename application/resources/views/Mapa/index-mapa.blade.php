@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Mapa do Crime')

  @section('page-title', 'Mapa do Crime')

  @section('content')

    <div class="row full-screen index-map">
      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/mapa/endereco')}}"><i class="material-icons right">add_location</i>Informar Endereço</a>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large sesp-blue col s12" href="{{url('/mapa/geolocalizacao')}}"><i class="material-icons right">place</i>Utilizar minha Localização</a>
        </div>
      </div>
    </div>

  @endsection
