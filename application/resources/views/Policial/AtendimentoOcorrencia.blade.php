@extends('Auxiliar/Layout/Model/policial-model')

  @section('navegador-title', 'Atender uma ocorrência')

  @section('page-title', 'Atender Ocorrencia')

  @section('content')


    <div class="row full-screen">

    @include('auxiliar/dados/ocorrencia/dados-ocorrencia')

    <div class="divider"></div>

      <h4 class="thin center-align">Informações do atendimento</h4>

      <form class="col s12" action="{{ url('/policial/atender-ocorrencia') }}" method="post">

        {{ csrf_field() }} <!-- Campo contra csrf -->

        <input type="hidden" name="ocorrencia_atendimento" value="{{ $ocorrencia['protocolo'] }}">
        <input type="hidden" name="policial_atendimento" value="1">

        <div class="row">
          <div class="input-field col s12 l4 offset-l2">
            <select name="policial_atendimento" id="policial_atendimento" required>
              <option value="" disabled selected>Escolha</option>
              @foreach($policiais as $policial)
              <option value="{{$policial['POLICIAL_CIVIL_MATRICULA']}}">{{$policial['POLICIAL_CIVIL_NOME']}}</option>
              @endforeach
            </select>
            <label>Responsável</label>
          </div>
          <div class="input-field col s12 l4">
            <input type="text" class="datepicker-ocorrencia" id="data_atendimento" name="data_atendimento" required>
            <label for="data_atendimento">Data do atendimento</label>
            <span class="field-error"> {{$errors->first('data_atendimento')}} </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea name="descricao_atendimento" class="materialize-textarea descricao-atendimento" required>{{ old('descricao_atendimento')}}</textarea>
            <label for="descricao_atendimento">Descrição do atendimento</label>
            <span class="field-error"> {{$errors->first('descricao_atendimento')}} </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light col s12 sesp-blue" type="submit" name="action">Salvar atendimento
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>

      </form>

      <div class="row">
        <a class="btn waves-effect waves-light red col s12 l4 offset-l4" onclick="history.back()">Voltar para ocorrência
          <i class="material-icons left">arrow_back</i>
        </a>
      </div>


    </div>

  @endsection
