@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Meu cadastro')

  @section('page-title', 'Meus dados')

  @section('content')

  <div class="row area-meucadastro">
    <div class="row hide-on-small-only">
      <div class="col s12 m12 l2 center-align">
        <img class="responsive-img usuario-foto" src="{{ asset('storage/rosto/'.$usuario['foto_rosto']) }}" alt="">
      </div>
      <div class="col s12 m12 l10">
        <div class="divider"></div>
        <div class="section">
          <h5 class="col s12 condensed light usuario-info-title"><i class="material-icons small" style="vertical-align: text-bottom;">account_circle</i> {{ $usuario['nome'] }}</h5>
          <div class="col s12 m12 l8">
            <p class="condensed light usuario-info"><i class="material-icons small" style="vertical-align: middle;">assignment_ind</i> {{ $usuario['identidade']}}</p>
            <p class="condensed light usuario-info"><i class="material-icons small" style="vertical-align: sub;">cake</i> {{ $usuario['dt_nascimento'] }}</p>
            <p class="condensed light usuario-info"><i class="material-icons small" style="vertical-align: middle;">place</i>
              {{ $usuario['endereco'] }}
          </div>
          <div class="col s12 m12 l4">
            <p class="condensed light usuario-info"><i class="material-icons small" style="vertical-align: middle;">smartphone</i> {{ $usuario['celular'] }}</p>
            <p class="condensed light usuario-info"><i class="material-icons small" style="vertical-align: middle;">mail</i> {{ $usuario['email'] }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="divider hide-on-small-only"></div>
    <h4 class="thin center-align">Minhas ocorrências</h4>
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
              <a href="/ocorrencia/visualizar/{{$ocorrencia['protocolo']}}" class="secondary-content"><i class="material-icons" style="color: #006a88">send</i></a>
            </li>
          @endforeach
        </ul>
      @else
        <blockquote class="bold">Você não possuí nenhuma ocorrência cadastrada ainda. <a href="{{url('/ocorrencia/registrar')}}">Clique aqui para registrar</a>.</blockquote>
      @endif
    </div>
  </div>

  @endsection
