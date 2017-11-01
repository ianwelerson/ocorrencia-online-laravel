@extends('Auxiliar/Layout/Model/policial-model')

  @section('navegador-title', 'Ocorrencias Cadastradas')

  @section('page-title', 'Lista de Ocorrencias')

  @section('content')

  <div class="row full-screen">

    <form class="col s12 full-screen" method="post" action="{{url('/policial/lista-ocorrencias')}}">

      {{ csrf_field() }} <!-- Campo contra csrf -->

      <div class="row">
        <div class="input-field col s12 l4 offset-l3">
          <input type="number" id="busca_ocorrencia" name="busca_ocorrencia" value="{{ old('busca_ocorrencia') }}">
          <label for="busca_ocorrencia">Código da Ocorrência</label>
        </div>

        <div class="input-field col s12 l4">
          <button class="btn waves-effect waves-light sesp-blue" type="submit" name="action">Buscar
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>

    </form>

    <div class="row lista-ocorrencias">
      <h4 class="thin center-align" >Ocorrências cadastradas</h4>
      <div class="row">
        @if($ocorrencias != null)
          <ul class="collection">
            @foreach($ocorrencias as $ocorrencia)
              <li class="collection-item avatar">
                <i class="material-icons circle">
                  @if($ocorrencia['tipo_cod'] <= 2)
                  phone_android
                  @elseif($ocorrencia['tipo_cod'] == 3)
                  assignment_ind
                  @endif
                </i>
                <span class="title">{{ $ocorrencia['tipo'] }}</span>
                <p>
                  Protocolo: {{$ocorrencia['protocolo']}}<br />
                  Data do ocorrido: {{ $ocorrencia['data'] }}
                </p>
                <a href="/policial/informacoes-ocorrencia/{{$ocorrencia['protocolo']}}" class="secondary-content"><i class="material-icons" style="color: #006a88">send</i></a>
              </li>
            @endforeach
          </ul>
        @else
          <blockquote>Não foram encontradas ocorrências com os critérios informados.</blockquote>
        @endif
      </div>
    </div>

  </div>

  @endsection
