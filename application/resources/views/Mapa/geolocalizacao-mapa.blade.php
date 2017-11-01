@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Mapa do Crime')

  @section('page-title', 'Mapa do Crime')

  @section('content')

    <div class="row full-screen">

      @include('Mapa/Comum/mapa')

    </div>

  @endsection
