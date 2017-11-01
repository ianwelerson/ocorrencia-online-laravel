@extends('Auxiliar/Layout/Model/policial-model')

  @section('navegador-title', 'Lista de usuários cadastrados')

  @section('page-title', 'Usuários cadastrados')

  @section('content')

  <div class="row full-screen">

    <form class="col s12 full-screen" method="post" action="{{url('/policial/lista-usuarios')}}">

      {{ csrf_field() }} <!-- Campo contra csrf -->

      <div class="row">

        <div class="input-field col s12 l4 offset-l3">
          <input type="number" id="busca_usuario" name="busca_usuario" value="{{ old('busca_usuario') }}">
          <label for="busca_usuario">Identidade</label>
        </div>

        <div class="input-field col s12 l4">
          <button class="btn waves-effect waves-light sesp-blue col s12 l6" type="submit" name="action">Buscar
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>

    </form>

    <div class="row lista-ocorrencias">
      <h4 class="thin center-align">Usuários cadastrados</h4>
      <div class="row">
        @if($usuarios != null)
        <table class="bordered">
          <thead>
            <tr>
                <th>Nome</th>
                <th>Identidade</th>
                <th>SIC</th>
                <th>SOM</th>
                <th>Fotos</th>
                <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach($usuarios as $usuario)
              <tr>
                <td>{{ $usuario['nome'] }}</td>
                <td>{{ $usuario['identidade'] }}</td>
                <td>
                  @if($usuario['ap_sic'] == false)
                      <i class="small material-icons">cancel</i>
                  @else
                      <i class="small material-icons">check_circle</i>
                  @endif
                </td>
                <td>
                  @if($usuario['ap_operadora'] == false)
                      <i class="small material-icons">cancel</i>
                  @else
                      <i class="small material-icons">check_circle</i>
                  @endif
                </td>
                <td>
                  @if($usuario['ap_fotos'] == false)
                      <i class="small material-icons">cancel</i>
                  @else
                      <i class="small material-icons">check_circle</i>
                  @endif
                </td>
                <td>
                  <a href="{{ url('/policial/informacoes-usuario/'.$usuario['codigo'])}}">Visualizar</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        @else
          <blockquote>Não foram encontrados usuários com esse critério no sistema.</blockquote>
        @endif
      </div>
    </div>

  </div>
  @endsection
