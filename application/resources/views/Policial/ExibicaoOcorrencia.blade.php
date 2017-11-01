@extends('Auxiliar/Layout/Model/policial-model')

  @section('navegador-title', 'Informações da Ocorrencia')

  @section('page-title', 'Informações da Ocorrência')

  @section('content')
  <div class="row full-screen">


    @include('auxiliar/dados/ocorrencia/dados-ocorrencia')

    <div class="col s12">
      <div class="col s12 l4 offset-l2">
        <a class="btn waves-effect waves-light red col s12" href="{{ url('/policial/lista-ocorrencias') }}">Voltar para lista
          <i class="material-icons left">arrow_back</i>
        </a>
      </div>
      <div class="col s12 l4">
        <a class="btn waves-effect waves-light sesp-blue col s12" href="{{ url('/policial/atender-ocorrencia/'.$ocorrencia['protocolo']) }}">Registrar Atendimento
          <i class="material-icons right">send</i>
        </a>
      </div>
    </div>

  </div>
  @endsection
