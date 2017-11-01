@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Criar cadastro')

  @section('page-title', 'Dados pessoais')

  @section('content')

    <div class="row">
      <form id="cadastro-usuario-form" class="col s12" method="post" action="{{url('/registrar')}}" enctype="multipart/form-data" >
        {{ csrf_field() }} <!-- Campo contra csrf -->
        <div class="row">
          <div class="input-field col l12 s12">
            <input type="text" id="usuario_nome" name="usuario_nome" onKeyPress="if(this.value.length==70) return false;" class="{{ $errors->get('usuario_nome') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_nome') ? '' : old("usuario_nome")}}" required>
            <label for="usuario_nome">Nome completo</label>
            <span class="field-error"> {{$errors->first('usuario_nome')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l4 s12">
              <input type="text" class="datepicker-birthday" id="usuario_dt_nasci" name="usuario_dt_nasci" value="{{ $errors->get('usuario_dt_nasci') ? '' : old("usuario_dt_nasci")}}" required>
              <label for="usuario_dt_nasci">Data de Nascimento</label>
            <span class="field-error"> {{$errors->first('usuario_dt_nasci')}} </span>
          </div>
          <div class="input-field col l4 s12">
              <input type="text" id="usuario_identidade" name="usuario_identidade" class="{{ $errors->get('usuario_identidade') ? 'invalid' : 'validate'}} identidade" value="{{ $errors->get('usuario_identidade') ? '' : old("usuario_identidade")}}" required>
              <label for="usuario_identidade">Número da Identidade</label>
            <span class="field-error"> {{$errors->first('usuario_identidade')}} </span>
          </div>
          <div class="input-field col l4 s12">
              <input type="text" id="usuario_cpf" name="usuario_cpf" class="{{ $errors->get('usuario_cpf') ? 'invalid' : 'validate cpf'}} cpf" value="{{ $errors->get('usuario_cpf') ? '' : old("usuario_cpf")}}" required>
              <label for="usuario_cpf">Número do CPF</label>
            <span class="field-error"> {{$errors->first('usuario_cpf')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l12 s12">
            <input type="text" id="usuario_nome_mae" name="usuario_nome_mae" onKeyPress="if(this.value.length==70) return false;" class="{{ $errors->get('usuario_nome_mae') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_nome_mae') ? '' : old("usuario_nome_mae")}}" required>
            <label for="usuario_nome_mae">Nome da mãe</label>
            <span class="field-error"> {{$errors->first('usuario_nome_mae')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l6 s12">
            <input type="text" id="usuario_tel_cel" name="usuario_tel_cel" class="{{ $errors->get('usuario_tel_cel') ? 'invalid' : 'validate'}} phone_with_ddd" value="{{ $errors->get('usuario_tel_cel') ? '' : old("usuario_tel_cel")}}" required>
            <label for="usuario_tel_cel">Telefone Celular</label>
            <span class="field-error"> {{$errors->first('usuario_tel_cel')}} </span>
          </div>
          <div class="input-field col l6 s12">
            <input type="text" id="usuario_tel_cel_verify" name="usuario_tel_cel_confirmation" class="{{ $errors->get('usuario_tel_cel') ? 'invalid' : 'validate'}} phone_with_ddd" value="{{ $errors->get('usuario_tel_cel') ? '' : old("usuario_tel_cel")}}" required>
            <label for="usuario_tel_cel_confirmation">Repetir telefone celular</label>
            <span class="field-error"> {{$errors->first('usuario_tel_cel')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l6 s12">
            <input type="email" id="usuario_email" name="usuario_email" class="{{ $errors->get('usuario_email') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_email') ? '' : old("usuario_email")}}" required>
            <label for="usuario_email">Email</label>
            <span class="field-error"> {{$errors->first('usuario_email')}} </span>
          </div>
          <div class="input-field col l6 s12">
            <input type="email" id="usuario_email_verify" name="usuario_email_confirmation" class="{{ $errors->get('usuario_email') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_email') ? '' : old("usuario_email")}}" required>
            <label for="usuario_email_confirmation">Repetir Email</label>
            <span class="field-error"> {{$errors->first('usuario_email')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="file-field input-field">
            <div class="btn sesp-blue col s9 l9 btn-fotos-registro">
              <span>Foto da carteira de Identidade</span>
              <input type="file" name="usuario_foto_doc" value="{{old('usuario_foto_doc')}}">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" value="{{old('usuario_foto_doc')}}">
            </div>
            <span class="field-error"> {{$errors->first('usuario_foto_doc')}} </span>
          </div>
          <div class="file-field input-field">
            <div class="btn sesp-blue col s9 l9 btn-fotos-registro">
              <span>Foto do rosto</span>
              <input type="file" name="usuario_foto_rosto" value="{{old('usuario_foto_rosto')}}">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" value="{{old('usuario_foto_rosto')}}">
            </div>
            <span class="field-error"> {{$errors->first('usuario_foto_rosto')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l3 s12">
            <input type="text" id="usuario_cep" name="usuario_cep" class="{{ $errors->get('usuario_cep') ? 'invalid' : 'validate'}} cep" value="{{ $errors->get('usuario_cep') ? '' : old("usuario_cep")}}" required>
            <label for="usuario_cep">CEP</label>
            <span class="field-error"> {{$errors->first('usuario_cep')}} </span>
          </div>
          <div class="input-field col l1 s12">
            <select name="tp_logradouro_cod" id="tp_logradouro_cod" required>
              @foreach($tp_logradouros as $tp_logradouro)
              <option value="{{ $tp_logradouro->TP_LOGRADOURO_COD }}" @if($tp_logradouro->TP_LOGRADOURO_COD == old("tp_logradouro_cod")) selected @endif>{{ $tp_logradouro->TP_LOGRADOURO_NOME }}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col l6 s12">
              <input type="text" id="usuario_logradouro" name="usuario_logradouro" class="{{ $errors->get('usuario_logradouro') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_logradouro') ? '' : old("usuario_logradouro")}}" required>
              <label for="usuario_logradouro">Nome do logradouro</label>
              <span class="field-error"> {{$errors->first('usuario_logradouro')}} </span>
          </div>
          <div class="input-field col l2 s12">
              <input type="number" id="usuario_numero_res" name="usuario_numero_res" class="{{ $errors->get('usuario_numero_res') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_numero_res') ? '' : old("usuario_numero_res")}}" required>
              <label for="usuario_numero_res">Número da residência</label>
              <span class="field-error"> {{$errors->first('usuario_numero_res')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l5 s12">
              <input type="text" id="usuario_complemento_res" name="usuario_complemento_res" class="{{ $errors->get('usuario_complemento_res') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_complemento_res') ? '' : old("usuario_complemento_res")}}">
              <label for="usuario_complemento_res">Complemento</label>
              <span class="field-error"> {{$errors->first('usuario_complemento_res')}} </span>
          </div>
          <div class="input-field col l4 s12">
            <select name="municipio_cod" id="municipio_cod">
              @foreach($municipios as $municipio)
                <option value="{{ $municipio->MUNICIPIO_COD }}" @if($municipio->MUNICIPIO_COD == old("municipio_cod")) selected @endif>{{ $municipio->MUNICIPIO_NOME }}</option>
              @endforeach
            </select>
            <label for="municipio_cod">Cidade</label>
          </div>
          <div class="input-field col l3 s12">
              <input type="text" id="usuario_bairro" name="usuario_bairro" class="{{ $errors->get('usuario_bairro') ? 'invalid' : 'validate'}}" value="{{ $errors->get('usuario_bairro') ? '' : old("usuario_bairro")}}" required>
              <label for="usuario_bairro">Bairro</label>
              <span class="field-error"> {{$errors->first('usuario_bairro')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l6 s12">
            <input type="password" id="usuario_senha" name="usuario_senha" onKeyPress="if(this.value.length==12) return false;" class="{{ $errors->get('usuario_senha') ? 'invalid' : 'validate'}}" required>
            <label for="usuario_senha">Senha</label>
            <span class="field-error"> {{$errors->first('usuario_senha')}} </span>
          </div>
          <div class="input-field col l6 s12">
            <input type="password" id="usuario_senha_verify" name="usuario_senha_confirmation" onKeyPress="if(this.value.length==12) return false;" class="{{ $errors->get('usuario_senha') ? 'invalid' : 'validate'}}" required>
            <label for="usuario_senha_confirmation">Repetir Senha</label>
            <span class="field-error"> {{$errors->first('usuario_senha')}} </span>
          </div>
        </div>

        <div class="row">
          <button class="btn waves-effect waves-light green col l12 s12 btn-efetuar-registro" type="submit" name="action">Salvar dados
            <i class="material-icons right">send</i>
          </button>
        </div>

      </form>

      <div class="center-align">
        <button class="btn waves-effect waves-light red btn-voltar" onclick="history.back()">Voltar
          <i class="material-icons left">arrow_back</i>
        </button>
      </div>

    </div>

  @endsection
