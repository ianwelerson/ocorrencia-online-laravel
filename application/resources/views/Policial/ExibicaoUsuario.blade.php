@extends('Auxiliar/Layout/Model/policial-model')

  @section('navegador-title', 'Aprovação de Usuário')

  @section('page-title', 'Informações do Usuário')

  @section('content')


  <div class="row full-screen">

    <ul class="collapsible" data-collapsible="expandable">
      <li>
        <div class="collapsible-header"><i class="material-icons">subject</i>Dados pessoais de {{ $usuario['nome'] }}</div>
        <div class="collapsible-body">
            <p>Identidade: {{ $usuario['identidade'] }}</p>
            <p>Data de Nascimento: {{ $usuario['dt_nascimento'] }}</p>
            <p>Endereço: {{ $usuario['endereco'] }}</p>
        </div>
      </li>

      <li>
        <div class="collapsible-header"><i class="material-icons">face</i>Foto do Rosto</div>
        <div class="collapsible-body">
           <img class="responsive-img materialboxed fotos-aprovacao" src="{{ asset('storage/rosto/'.$usuario['foto_rosto']) }}" alt="">
        </div>
      </li>

      <li>
        <div class="collapsible-header"><i class="material-icons">assignment_ind</i>Foto do Documento</div>
        <div class="collapsible-body">
           <img class="responsive-img materialboxed fotos-aprovacao" src="{{ asset('storage/documento/'.$usuario['foto_doc']) }}" alt="">
        </div>
      </li>
    </ul>

    <form class="col s12" action="{{ url('/policial/aprovar-usuario/'.$usuario['codigo']) }}" method="get">

      {{ csrf_field() }} <!-- Campo contra csrf -->

      <div class="row">
        <div class="input-field col s12 ">
          <select name="policial_aprovacao" id="policial_aprovacao" required>
            <option value="" disabled selected>Escolha</option>
            @foreach($policiais as $policial)
            <option value="{{$policial['POLICIAL_CIVIL_MATRICULA']}}">{{$policial['POLICIAL_CIVIL_NOME']}}</option>
            @endforeach
          </select>
          <label>Responsável pela aprovação</label>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light col s12 sesp-blue {{$usuario['ap_fotos'] ? 'disabled' : ''}}" type="submit" name="action">Aprovar usuário
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
    </form>


    <div class="row">
      <div class="col s12 l4 offset-l4">
        <a class="btn waves-effect waves-light red col s12 l12" href="{{url('/policial/lista-usuarios')}}">Voltar
          <i class="material-icons left">arrow_back</i>
        </a>
      </div>
    </div>

  </div>


  @endsection
