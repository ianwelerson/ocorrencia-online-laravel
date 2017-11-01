@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Mapa do Crime')

  @section('page-title', 'Mapa do Crime')

  @section('content')

    <div class="row full-screen">

      <blockquote>
        Somente o preenchimento do municipio é obrigatório, os demais campos são para uma localização mais exata.
      </blockquote>

      <form method="post" action="{{url('/mapa/endereco')}}">
        {{ csrf_field() }} <!-- Campo contra csrf -->
        <div class="row">
          <div class="input-field col s12 l2">
            <select class="" id="endereco_municipio" name="endereco_municipio" required>
              <option value="" selected>Selecione</option>
              @foreach($municipios as $municipio)
                <option value="{{ $municipio->MUNICIPIO_COD }}" @if($municipio->MUNICIPIO_COD == old("endereco_municipio")) selected @endif>{{ $municipio->MUNICIPIO_NOME }}</option>
              @endforeach
            </select>
            <label for="cidade">Cidade</label>
            <span class="field-error"> {{$errors->first('endereco_municipio')}} </span>
          </div>
          <div class="input-field col s12 l1">
            <input type="number" id="endereco_cep" name="endereco_cep" value="{{old('endereco_cep')}}">
            <label for="nome_rua">CEP</label>
            <span class="field-error"> {{$errors->first('endereco_cep')}} </span>
          </div>
          <div class="input-field col s12 l4">
            <input type="text" id="endereco_rua" name="endereco_rua" value="{{old('endereco_rua')}}">
            <label for="nome_rua">Nome da rua</label>
            <span class="field-error"> {{$errors->first('endereco_rua')}} </span>
          </div>
          <div class="input-field col s12 l1">
            <input type="number" id="endereco_numero" name="endereco_numero" value="{{old('endereco_numero')}}">
            <label for="numero_rua">Número</label>
            <span class="field-error"> {{$errors->first('endereco_numero')}} </span>
          </div>
          <div class="input-field col s12 l2">
            <input type="text" id="endereco_bairro" name="endereco_bairro" value="{{old('endereco_bairro')}}">
            <label for="bairro">Bairro</label>
            <span class="field-error"> {{$errors->first('endereco_bairro')}} </span>
          </div>
          <div class="input-field col s12 l2">
            <button class="btn waves-effect waves-light col s12 sesp-blue" type="submit" name="action">Buscar no mapa
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>

      </form>

      @include('Mapa/Comum/mapa')

    </div>

  @endsection
