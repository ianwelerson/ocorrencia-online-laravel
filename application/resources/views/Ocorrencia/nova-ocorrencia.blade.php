@extends('Auxiliar/Layout/Model/padrao-model')

  @section('navegador-title', 'Registrar Ocorrência')

  @section('page-title', 'Registrar Ocorrência')

  @section('content')

  <div class="row full-screen">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s4"><a href="#descricao-ocorrencia" class="active">Descrição</a></li>
        <li class="tab col s4"><a href="#objetos-ocorrencia">Objetos</a></li>
        <li class="tab col s4"><a href="#envolvidos-ocorrencia">Envolvidos</a></li>
      </ul>
    </div>

    <form id="ocorrencia-form" class="col s12" method="post" action="{{ url('/ocorrencia/registrar') }}" >

      {{ csrf_field() }} <!-- Campo contra csrf -->

      <div id="descricao-ocorrencia" class="col s12">

        <div class="row">
          <div class="input-field col s12 l5">
            <select id="tp_ocorrencia_cod" name="tp_ocorrencia_cod" class="{{ $errors->get('tp_ocorrencia_cod') ? 'invalid' : 'validate'}}" required>
              <option value="" selected disabled>Selecione</option>
                @foreach($tp_ocorrencias as $tp_ocorrencia)
                  <option value="{{ $tp_ocorrencia->TP_OCORRENCIA_COD }}" @if($tp_ocorrencia->TP_OCORRENCIA_COD == old("tp_ocorrencia_cod")) selected @endif>{{ $tp_ocorrencia->TP_OCORRENCIA_NOME }}</option>
                @endforeach
            </select>
            <label for="tp_ocorrencia_cod">Tipo de ocorrência</label>
            <span class="field-error">{{$errors->first('tp_ocorrencia_cod')}}</span>
          </div>

          <div class="input-field col s12 l6 offset-l1">
            <input type="text" id="ocorrencia_data" name="ocorrencia_data" class="datepicker-ocorrencia {{ $errors->get('ocorrencia_data') ? 'invalid' : ''}}" value="{{ ($errors->get('ocorrencia_data')) ? '' : old('ocorrencia_data')}}" required>
            <label for="ocorrencia_data">Data do ocorrido</label>
            <span class="field-error">{{$errors->first('ocorrencia_data')}}</span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <textarea name="ocorrencia_desc" id="ocorrencia_desc" class="materialize-textarea {{ $errors->get('ocorrencia_desc') ? 'invalid' : 'validate'}}" required>{{ $errors->get('ocorrencia_desc') ? '' : old("ocorrencia_desc")}}</textarea>
            <label for="ocorrencia_desc">Descrição do ocorrido</label>
            <span class="field-error">{{$errors->first('ocorrencia_desc')}}</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col l3 s12">
            <input type="text" id="ocorrencia_cep" name="ocorrencia_cep" class="{{ $errors->get('ocorrencia_cep') ? 'invalid' : 'validate'}} cep" value="{{ $errors->get('ocorrencia_cep') ? '' : old("ocorrencia_cep")}}">
            <label for="ocorrencia_cep">CEP</label>
            <span class="field-error"> {{$errors->first('ocorrencia_cep')}} </span>
          </div>
          <div class="input-field col l1 s12">
            <select name="ocorrencia_tp_logradouro_cod" id="ocorrencia_tp_logradouro_cod">
              <option value="" selected disabled>Selecione</option>
              @foreach($tp_logradouros as $tp_logradouro)
              <option value="{{ $tp_logradouro->TP_LOGRADOURO_COD }}" @if($tp_logradouro->TP_LOGRADOURO_COD == old("ocorrencia_tp_logradouro_cod")) selected @endif>{{ $tp_logradouro->TP_LOGRADOURO_NOME }}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col l6 s12">
              <input type="text" id="ocorrencia_logradouro" name="ocorrencia_logradouro" class="{{ $errors->get('ocorrencia_logradouro') ? 'invalid' : 'validate'}}" value="{{ $errors->get('ocorrencia_logradouro') ? '' : old("ocorrencia_logradouro")}}">
              <label for="ocorrencia_logradouro">Nome do logradouro</label>
              <span class="field-error"> {{$errors->first('ocorrencia_logradouro')}} </span>
          </div>
          <div class="input-field col l2 s12">
              <input type="number" id="ocorrencia_num_local" name="ocorrencia_num_local" class="{{ $errors->get('ocorrencia_num_local') ? 'invalid' : 'validate'}}" value="{{ $errors->get('ocorrencia_num_local') ? '' : old('ocorrencia_num_local')}}">
              <label for="ocorrencia_num_local">Número</label>
              <span class="field-error"> {{$errors->first('ocorrencia_num_local')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l5 s12">
              <input type="text" id="ocorrencia_complemento_local" name="ocorrencia_complemento_local" class="{{ $errors->get('ocorrencia_complemento_local') ? 'invalid' : 'validate'}}" value="{{ $errors->get('ocorrencia_complemento_local') ? '' : old('ocorrencia_complemento_local')}}">
              <label for="ocorrencia_complemento_local">Complemento</label>
              <span class="field-error"> {{$errors->first('ocorrencia_complemento_local')}} </span>
          </div>
          <div class="input-field col l4 s12">
            <select name="ocorrencia_municipio_cod" id="ocorrencia_municipio_cod" required>
              <option value="" selected disabled>Selecione</option>
              @foreach($municipios as $municipio)
                <option value="{{ $municipio->MUNICIPIO_COD }}" @if($municipio->MUNICIPIO_COD == old("ocorrencia_municipio_cod")) selected @endif>{{ $municipio->MUNICIPIO_NOME }}</option>
              @endforeach
            </select>
            <label for="municipio_cod">Cidade</label>
            <span class="field-error"> {{$errors->first('ocorrencia_municipio_cod')}} </span>
          </div>
          <div class="input-field col l3 s12">
              <input type="text" id="ocorrencia_bairro" name="ocorrencia_bairro" class="{{ $errors->get('ocorrencia_bairro') ? 'invalid' : 'validate'}}" value="{{ $errors->get('ocorrencia_bairro') ? '' : old('ocorrencia_bairro')}}">
              <label for="ocorrencia_bairro">Bairro</label>
              <span class="field-error"> {{$errors->first('ocorrencia_bairro')}} </span>
          </div>
        </div>

        <!-- Botões para navegar entre as abas -->
        <div class="row">
          <a class="waves-effect waves-light btn col s5 offset-s7 green" id="tab-objetos-ocorrencia" style="margin-top: 10px;">Próxima etapa
            <i class="material-icons right">arrow_forward</i>
          </a>
        </div>
        <!-- FIM Botões para navegar entre as abas -->
      </div>


      <div id="objetos-ocorrencia" class="col s12">

        <div class="row">
          <blockquote>
            Utilize os campos abaixo para informar os dados de um objeto envolvido na ocorrência.
          </blockquote>
        </div>

        <div class="row">
          <div class="input-field col s12 l4">
            <select id="tp_objeto_cod" name="tp_objeto_cod" class="{{ $errors->get('tp_objeto_cod') ? 'invalid' : 'validate'}}" value="{{ $errors->get('tp_objeto_cod') ? '' : old('tp_objeto_cod')}}">
              <option selected disabled>Selecione</option>
              @foreach($tp_objetos as $tp_objeto)
              <option value="{{ $tp_objeto->TP_OBJETO_COD }}" @if($tp_objeto->TP_OBJETO_COD == old("tp_objeto_cod")) selected @endif>{{ $tp_objeto->TP_OBJETO_NOME }}</option>
              @endforeach
            </select>
            <label for="tp_objeto_cod">Tipo de Objeto</label>
            <span class="field-error">{{$errors->first('tp_objeto_cod')}}</span>
          </div>
          <div class="input-field col s12 l4">
            <select id="un_medida_cod" name="un_medida_cod" class="{{ $errors->get('un_medida_cod') ? 'invalid' : 'validate'}}" value="{{ $errors->get('un_medida_cod') ? '' : old('un_medida_cod')}}">
              <option selected disabled>Selecione</option>
              @foreach($un_medidas as $un_medida)
              <option value="{{ $un_medida->UN_MEDIDA_COD }}" @if($un_medida->UN_MEDIDA_COD == old("un_medida_cod")) selected @endif>{{ $un_medida->UN_MEDIDA_NOME }}</option>
              @endforeach
            </select>
            <label for="un_medida_cod">Unidade de Medida</label>
            <span class="field-error">{{$errors->first('un_medida_cod')}}</span>
          </div>
          <div class="input-field col s12 l4">
            <input type="number" id="objeto_quant" name="objeto_quant" class="{{ $errors->get('objeto_quant') ? 'invalid' : 'validate'}}" value="{{ $errors->get('objeto_quant') ? '' : old('objeto_quant')}}">
            <label for="objeto_quant">Quantidade</label>
            <span class="field-error">{{$errors->first('objeto_quant')}}</span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <textarea name="objeto_desc" id="objeto_desc" class="materialize-textarea {{ $errors->get('objeto_desc') ? 'invalid' : 'validate'}}">{{ $errors->get('objeto_desc') ? '' : old("objeto_desc")}}</textarea>
            <label for="objeto_desc">Descrição do Objeto</label>
            <span class="field-error">{{$errors->first('objeto_desc')}}</span>
          </div>
        </div>

        <!-- Botões para navegar entre as abas -->
        <div class="row">
          <a class="waves-effect waves-light btn col s5 red" id="tab-descricao-ocorrencia" style="margin-top: 10px;">Etapa anterior
            <i class="material-icons left">arrow_back</i>
          </a>
          <a class="waves-effect waves-light btn col s5 offset-s2 green" id="tab-envolvidos-ocorrencia" style="margin-top: 10px;">Próxima etapa
            <i class="material-icons right">arrow_forward</i>
          </a>
        </div>
        <!-- FIM Botões para navegar entre as abas -->

      </div>

      <div id="envolvidos-ocorrencia" class="col s12">

        <div class="row">
          <div class="input-field col s12 l3">
            <select name="tp_envolvimento_cod" id="tp_envolvimento_cod">
              <option value="" selected>Selecione</option>
              @foreach($tp_envolvimentos as $tp_envolvimento)
                <option value="{{ $tp_envolvimento->TP_ENVOLVIMENTO_COD }}" @if($tp_envolvimento->TP_ENVOLVIMENTO_COD == old("tp_envolvimento_cod")) selected @endif>{{ $tp_envolvimento->TP_ENVOLVIMENTO_NOME }}</option>
              @endforeach
            </select>
            <label for="tp_envolvimento_cod">Envolvimento </label>
            <span class="field-error"> {{$errors->first('tp_envolvimento_cod')}} </span>
          </div>
          <div class="input-field col s12 l9">
            <input type="text" id="envolvido_nome" name="envolvido_nome" onKeyPress="if(this.value.length==70) return false;" class="{{ $errors->get('envolvido_nome') ? 'invalid' : 'validate'}}" value="{{ $errors->get('envolvido_nome') ? '' : old('envolvido_nome')}}">
            <label for="envolvido_nome">Nome completo</label>
            <span class="field-error"> {{$errors->first('envolvido_nome')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l4 s12">
              <input type="text" class="datepicker-birthday" id="envolvido_dt_nasc" name="envolvido_dt_nasc" value="{{ $errors->get('envolvido_dt_nasc') ? '' : old('envolvido_dt_nasc')}}">
              <label for="envolvido_dt_nasc">Data de Nascimento</label>
            <span class="field-error"> {{$errors->first('envolvido_dt_nasc')}} </span>
          </div>
          <div class="input-field col l4 s12">
              <input type="text" id="envolvido_indentidade" name="envolvido_indentidade" class="{{ $errors->get('envolvido_indentidade') ? 'invalid' : 'validate'}} identidade" value="{{ $errors->get('envolvido_indentidade') ? '' : old('envolvido_indentidade')}}">
              <label for="envolvido_indentidade">Número da Identidade</label>
            <span class="field-error"> {{$errors->first('envolvido_indentidade')}} </span>
          </div>
          <div class="input-field col l4 s12">
              <input type="text" id="envolvido_cpf" name="envolvido_cpf" class="{{ $errors->get('envolvido_cpf') ? 'invalid' : 'validate cpf'}} cpf" value="{{ $errors->get('envolvido_cpf') ? '' : old('envolvido_cpf')}}" >
              <label for="envolvido_cpf">Número do CPF</label>
            <span class="field-error"> {{$errors->first('envolvido_cpf')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l12 s12">
            <input type="text" id="envolvido_nome_mae" name="envolvido_nome_mae" onKeyPress="if(this.value.length==70) return false;" class="{{ $errors->get('envolvido_nome_mae') ? 'invalid' : 'validate'}}" value="{{ $errors->get('envolvido_nome_mae') ? '' : old('envolvido_nome_mae')}}" >
            <label for="envolvido_nome_mae">Nome da mãe</label>
            <span class="field-error"> {{$errors->first('envolvido_nome_mae')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l6 s12">
            <input type="text" id="envolvido_tel_contato" name="envolvido_tel_contato" class="{{ $errors->get('envolvido_tel_contato') ? 'invalid' : 'validate'}} phone_with_ddd" value="{{ $errors->get('envolvido_tel_contato') ? '' : old('envolvido_tel_contato')}}" >
            <label for="envolvido_tel_contato">Telefone Celular</label>
            <span class="field-error"> {{$errors->first('envolvido_tel_contato')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l3 s12">
            <input type="text" id="envolvido_cep" name="envolvido_cep" class="{{ $errors->get('envolvido_cep') ? 'invalid' : 'validate'}} cep" value="{{ $errors->get('envolvido_cep') ? '' : old('envolvido_cep')}}" >
            <label for="envolvido_cep">CEP</label>
            <span class="field-error"> {{$errors->first('envolvido_cep')}} </span>
          </div>
          <div class="input-field col l1 s12">
            <select name="envolvido_tp_logradouro_cod" id="envolvido_tp_logradouro_cod">
              <option value="" selected>Selecione</option>
              @foreach($tp_logradouros as $tp_logradouro)
                <option value="{{ $tp_logradouro->TP_LOGRADOURO_COD }}" @if($tp_logradouro->TP_LOGRADOURO_COD == old("envolvido_tp_logradouro_cod")) selected @endif>{{ $tp_logradouro->TP_LOGRADOURO_NOME }}</option>
              @endforeach
            </select>
            <span class="field-error"> {{$errors->first('envolvido_tp_logradouro_cod')}} </span>
          </div>
          <div class="input-field col l6 s12">
              <input type="text" id="envolvido_logradouro" name="envolvido_logradouro" class="{{ $errors->get('envolvido_logradouro') ? 'invalid' : 'validate'}}" value="{{ $errors->get('envolvido_logradouro') ? '' : old('envolvido_logradouro')}}" >
              <label for="envolvido_logradouro">Nome do logradouro</label>
              <span class="field-error"> {{$errors->first('envolvido_logradouro')}} </span>
          </div>
          <div class="input-field col l2 s12">
              <input type="number" id="envolvido_num_res" name="envolvido_num_res" class="{{ $errors->get('envolvido_num_res') ? 'invalid' : 'validate'}}" value="{{ $errors->get('envolvido_num_res') ? '' : old('envolvido_num_res')}}" >
              <label for="envolvido_num_res">Número da residência</label>
              <span class="field-error"> {{$errors->first('envolvido_num_res')}} </span>
          </div>
        </div>

        <div class="row">
          <div class="input-field col l5 s12">
              <input type="text" id="envolvido_comp_res" name="envolvido_comp_res" class="{{ $errors->get('envolvido_comp_res') ? 'invalid' : 'validate'}}" value="{{ $errors->get('envolvido_comp_res') ? '' : old('envolvido_comp_res')}}">
              <label for="envolvido_comp_res">Complemento</label>
              <span class="field-error"> {{$errors->first('envolvido_comp_res')}} </span>
          </div>
          <div class="input-field col l4 s12">
            <select name="envolvido_municipio_cod" id="envolvido_municipio_cod">
              <option value="" selected>Selecione</option>
              @foreach($municipios as $municipio)
                <option value="{{ $municipio->MUNICIPIO_COD }}" @if($municipio->MUNICIPIO_COD == old("envolvido_municipio_cod")) selected @endif>{{ $municipio->MUNICIPIO_NOME }}</option>
              @endforeach
            </select>
            <label for="municipio_cod">Cidade</label>
            <span class="field-error"> {{$errors->first('envolvido_municipio_cod')}} </span>
          </div>
          <div class="input-field col l3 s12">
              <input type="text" id="envolvido_bairro" name="envolvido_bairro" class="{{ $errors->get('envolvido_bairro') ? 'invalid' : 'validate'}}" value="{{ $errors->get('envolvido_bairro') ? '' : old('envolvido_bairro')}}" >
              <label for="envolvido_bairro">Bairro</label>
              <span class="field-error"> {{$errors->first('envolvido_bairro')}} </span>
          </div>
        </div>

        <!-- Botão de chamada do Model com a confirmação de envio de do formulário -->
        <a class="waves-effect waves-light btn modal-trigger col s12 sesp-blue" href="#salvarDados" style="margin-top: 20px;">Salvar Ocorrência
          <i class="material-icons right">send</i>
        </a>

      </div>

      <!-- Modal com a mensagem e botão de envio -->
      <div id="salvarDados" class="modal">
        <div class="modal-content">
          <h4>Salvar informações</h4>
          <blockquote>Tenha certeza de ter informado todos os campos no preenchimento, não será possível editar o registro</blockquote>
          <p>
            Verifique se os campos referentes aos objetos envolvidos foram preenchidos, caso tenha algum objeto.
            <br />
            Verifique se os campos referentes aos envolvidos foram preenchidos, caso tenha algum envolvido.
          </p>

        </div>
        <div class="modal-footer">
          <button class="modal-action modal-close waves-effect sesp-blue btn-flat" type="submit" name="action" style="color:white;">Salvar ocorrência
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>

    </form>
  </div>

  @endsection
