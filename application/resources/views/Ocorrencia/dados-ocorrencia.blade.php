@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Informações da Ocorrencia')

  @section('page-title', 'Ocorrência')

  @section('content')
  <div class="row full-screen">

    @include('Auxiliar/Dados/Ocorrencia/dados-ocorrencia')

    <div class="center-align">
      <a class="btn waves-effect waves-light red btn-voltar-registro" href="{{url('/meu-cadastro')}}">Meu cadastro
        <i class="material-icons left">arrow_back</i>
      </a>
    </div>

  </div>
  @endsection
