@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Acessar cadastro')

  @section('page-title', 'Acessar')

  @section('content')

  <div class="row full-screen">
    <form id="login-form" class="col s12" method="post" action="{{url('/acessar')}}">
      {{ csrf_field() }} <!-- Campo contra csrf -->
      <div class="row">
        <div class="row">
          <div class="input-field col s12 l6 offset-l3">
            <i class="material-icons prefix">account_circle</i>
            <input  type="text" id="usuario_identidade" name="usuario_identidade" class="validate identidade" required>
            <label for="usuario_identidade">Número da Identidade</label>
            <span class="field-error" style="padding-left: 45px;">{{$errors->first('usuario_identidade')}}</span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 l6 offset-l3">
            <i class="material-icons prefix">vpn_key</i>
            <input type="password" id="usuario_senha" name="usuario_senha" onKeyPress="if(this.value.length==12) return false;" class="validate" required>
            <label for="usuario_senha">Senha</label>
            <span class="field-error" style="padding-left: 45px;">{{$errors->first('usuario_senha')}}</span>
          </div>
        </div>

        <div class="row">
          <div class="col s12 l6 offset-l3">
            <button class="btn waves-effect waves-light sesp-blue col l12 s12" type="submit" name="action">Acessar
              <i class="material-icons right">send</i>
            </button>
            <p class="center-align cadastre-se-agora">Ainda não possuí conta? <a href="{{url('/registrar')}}">Cadastre-se agora</a></p>
          </div>
        </div>

      </div>
    </form>
  </div>

  @endsection
