<?php

namespace OcorrenciaOnline\Http\Controllers\Ocorrencia;

//Nativos
use Auth;
use URL;
//Modelos
use OcorrenciaOnline\Ocorrencia;
use OcorrenciaOnline\Tp_Envolvimento;
use OcorrenciaOnline\Tp_Logradouro;
use OcorrenciaOnline\Tp_Objeto;
use OcorrenciaOnline\Tp_Ocorrencia;
use OcorrenciaOnline\Un_Medida;
use OcorrenciaOnline\Municipio;
//Controllers
use OcorrenciaOnline\Http\Controllers\Controller;
use OcorrenciaOnline\Http\Controllers\Localizacao\LocalizacaoController;
use OcorrenciaOnline\Http\Controllers\Usuario\UsuarioController;
use OcorrenciaOnline\Http\Controllers\Policial\AtendimentoController;
//Requests
use OcorrenciaOnline\Http\Requests\RegistroOcorrenciaRequest;
use OcorrenciaOnline\Http\Requests\BuscaOcorrenciaRequest;
// Classes
use OcorrenciaOnline\Classes\Ocorrencia\Objetos;
use OcorrenciaOnline\Classes\Ocorrencia\Envolvidos;

class OcorrenciaController extends Controller
{
    /**
     * Exibe o formulário de criação de ocorrência
     */
    public function index()
    {
      // Retorna a view de cadastro de ocorrência com os dados de municipios, tipos de logradouro, ocorrencias, objetos, envolvimento e as unidades de medida
      return view('Ocorrencia/index-ocorrencia');
    }

    /**
     * Exibe o formulário de criação de ocorrência
     */
    public function create()
    {
      // Retorna a view de cadastro de ocorrência com os dados de municipios, tipos de logradouro, ocorrencias, objetos, envolvimento e as unidades de medida
      return view('Ocorrencia/nova-ocorrencia')
        ->with('municipios',        Municipio::all())
        ->with('tp_logradouros',    Tp_Logradouro::all())
        ->with('tp_ocorrencias',    Tp_Ocorrencia::all())
        ->with('tp_objetos',        Tp_Objeto::all())
        ->with('tp_envolvimentos',  Tp_Envolvimento::all())
        ->with('un_medidas',        Un_Medida::all());
    }

    /**
     * Armazena no banco os dados da ocorrência recebidos por request
     */
    public function store(RegistroOcorrenciaRequest $request)
    {
      // Cria o acesso ao Controller de Localizacao
      $localizacaoController = new LocalizacaoController();
      // Executa a function getCoordinates() do controller de localização, para obter as coordenadas da ocorrência
      $coordenadas = $localizacaoController->getCoordinates(
        Municipio::find($request['ocorrencia_municipio_cod'])->MUNICIPIO_NOME,
        $request['ocorrencia_cep'],
        $request['ocorrencia_logradouro'],
        $request['ocorrencia_num_local'],
        $request['ocorrencia_bairro']
      );

      // Registra no banco os dados da ocorrência
      $ocorrencia_resposta = Ocorrencia::create([
        'USUARIO_COD'                   => Auth::user()->USUARIO_COD, // Utiliza o código do usuário autenticado para registrar no responsável
        'TP_OCORRENCIA_COD'             => $request['tp_ocorrencia_cod'],
        'OCORRENCIA_DATA'               => $request['ocorrencia_data'],
        'OCORRENCIA_DESC'               => $request['ocorrencia_desc'],
        'OCORRENCIA_CEP'                => $request['ocorrencia_cep'],
        'MUNICIPIO_COD'                 => $request['ocorrencia_municipio_cod'],
        'TP_LOGRADOURO_COD'             => $request['tp_logradouro_cod'],
        'OCORRENCIA_LOGRADOURO'         => $request['ocorrencia_logradouro'],
        'OCORRENCIA_NUM_LOCAL'          => $request['ocorrencia_num_local'],
        'OCORRENCIA_COMPLEMENTO_LOCAL'  => $request['ocorrencia_complemento_local'],
        'OCORRENCIA_BAIRRO'             => $request['ocorrencia_bairro'],
        'OCORRENCIA_LAT'                => $coordenadas['latitude'],
        'OCORRENCIA_LONG'               => $coordenadas['longitude'],
        'OCORRENCIA_IP_REG'             => $_SERVER['REMOTE_ADDR']
      ]);

      // Verifica se existe um objeto adicionado na ocorrencia
      if($request['tp_objeto_cod'] != null) {
        // Cria uma instância de Objeto
        $ObjetosClass = new Objetos();
        // Cria um array com os dados do objeto que foi inserido na ocorrência
        $objetos = [
          'ocorrencia_cod'                => $ocorrencia_resposta->OCORRENCIA_COD,
          'tp_objeto_cod'                 => $request['tp_objeto_cod'],
          'un_medida_cod'                 => $request['un_medida_cod'],
          'objeto_quant'                  => $request['objeto_quant'],
          'objeto_desc'                   => $request['objeto_desc']
        ];
        // Executa a function store de objetos para salvar os dados
        $objeto_resposta = $ObjetosClass->store($objetos);
      }

      // Verifica se existe um objeto adicionado na ocorrência, se exstir realiza os procedimentos
      if($request['tp_envolvimento_cod'] != null) {
        // Cria uma instância de Envolvidos
        $EnvolvidosClass = new Envolvidos();
        //Cria um array com os dados do envolvido que foi inserido na ocorrência
        $envolvidos = [
          'ocorrencia_cod'                => $ocorrencia_resposta->OCORRENCIA_COD,
          'tp_envolvimento_cod'           => $request['tp_envolvimento_cod'],
          'envolvido_nome'                => $request['envolvido_nome'],
          'envolvido_dt_nasc'             => $request['envolvido_dt_nasc'],
          'envolvido_indentidade'         => $request['envolvido_indentidade'],
          'envolvido_cpf'                 => $request['envolvido_cpf'],
          'envolvido_nome_mae'            => $request['envolvido_nome_mae'],
          'envolvido_tel_contato'         => $request['envolvido_tel_contato'],
          'municipio_cod'                 => $request['envolvido_municipio_cod'],
          'tp_logradouro_cod'             => $request['envolvido_tp_logradouro_cod'],
          'envolvido_logradouro'          => $request['envolvido_logradouro'],
          'envolvido_num_res'             => $request['envolvido_num_res'],
          'envolvido_comp_res'            => $request['envolvido_comp_res'],
          'envolvido_bairro'              => $request['envolvido_bairro'],
          'envolvido_cep'                 => $request['envolvido_cep']
        ];
        //Executa function store de Envolvidos para salvar os dados
        $envolvidos_resposta = $EnvolvidosClass->store($envolvidos);
      }
      // Retorna para a view com os dados da ocorrência cadastrada e uma mensagem de cadastro efetuado
      return Redirect('ocorrencia/visualizar/'.$ocorrencia_resposta['OCORRENCIA_COD'])
        ->with('mensagem_sucesso', 'Sua ocorrência foi cadastrada com sucesso. Aguarde mais informações...');
    }

    /**
     * Exibe os dados de uma ocorrência
     */
    public function show($id) {
      // Executa a function getOcorrenciaData() para obter os dados da ocorrência
      $ocorrencia = $this->getOcorrenciaData($id);
      // Verifica se o usuário que está tentando acessar a ocorrência e é o responsável por ela
      if(Auth::user()->USUARIO_COD === $ocorrencia['responsavel']['codigo']) {
        // Retorna a view de informação da ocorrência com os dados da ocorrência e do usuário autenticado
        return view('Ocorrencia/dados-ocorrencia')
          ->with('ocorrencia', $ocorrencia);
      } else {
        // Caso o usuário não seja o responsável pela ocorrência é retornado para a tela anterior com uma mensagem de erro
        return Redirect(URL::previous())
          ->with('mensagem_erro', 'Acesso negado!');
      }

    }

    /**
     * Busca no banco todas as ocorrências registradas por um usuário para exibição no MeuCadastro
     */
    public function getUserRegisters($usuarioID)
    {
      // Realiza a busca no banco por todas as ocorrências registradas que possuem como responsável o usuário informado
      $ocorrencias_bd = Ocorrencia::where('USUARIO_COD', $usuarioID)->get();
      // Cria um array de ocorrências
      $ocorrencias = array();
      // Para cada ocorrência encontrada
      foreach($ocorrencias_bd as $ocorrencia) {
        // Executa a function getOcorrenciaData()
        $ocorrencia = $this->getOcorrenciaData($ocorrencia->OCORRENCIA_COD);
        // Faz a inserção da ocorrência no array
        array_push($ocorrencias, $ocorrencia);
      }
      // Retorna o array de ocorrências, porém ele é retornado ao contrário, para que a lista faça a exibição da última para a primeira
      return array_reverse($ocorrencias);
    }

    /**
     * Busca no banco uma ocorrência informada e retorna um array com os dados dela
     */
    public function getOcorrenciaData($id)
    {

      // Acessa o Banco e busca o ocorrência solicitada
      $ocorrencia_bd = Ocorrencia::find($id);
      // Se encontrar a ocorrência
      if($ocorrencia_bd == true) {
        // Cria a instância do Controller do Usuario
        $usuarioController = new UsuarioController();
        // Cria a instância do Controller de Localizacao
        $localizacaoController = new LocalizacaoController();
        // Cria a instância do Controller de Atendimento
        $atendimentoController = new AtendimentoController();
        // Cria  a instância de Envolvidos
        $EnvolvidosClass = new Envolvidos();
        // Cria a instância de Objetos
        $ObjetosClass = new Objetos();
        // Executa a function getUserData() do controller usuario e obtem os dados do usuário responsável pela ocorrência, em um array
        $responsavel = $usuarioController->getUserData($ocorrencia_bd->USUARIO_COD);
        // Executa a function getEnvolvidosData() de Envolvido e obtem os dados dos envolvidos, em um array
        $envolvidos = $EnvolvidosClass->getEnvolvidosData($ocorrencia_bd->OCORRENCIA_COD);
        // Executa a function getObjetosData() de Objeto e obtem os dados dos objetos, em um array
        $objetos = $ObjetosClass->getObjetosData($ocorrencia_bd->OCORRENCIA_COD);

        // Executa a function addressMount() e obtem uma string com o endereço da ocorrência
        $endereco_ocorrencia = $localizacaoController->addressMount(
          (($ocorrencia_bd->TP_LOGRADOURO_COD != null) ? $ocorrencia_bd->tipo_logradouro->TP_LOGRADOURO_NOME : ''),
          $ocorrencia_bd->OCORRENCIA_LOGRADOURO,
          $ocorrencia_bd->OCORRENCIA_NUM_LOCAL,
          $ocorrencia_bd->OCORRENCIA_BAIRRO,
          $ocorrencia_bd->municipio->MUNICIPIO_NOME,
          $ocorrencia_bd->OCORRENCIA_CEP,
          $ocorrencia_bd->OCORRENCIA_COMPLEMENTO_LOCAL
        );

        // Executa a function getAttend() do Controller de Atendimentos, para obter os dados referentes aos atendimentos de uma ocorrência. O retorno é um array
        $atendimentos = $atendimentoController->getAttend($ocorrencia_bd->OCORRENCIA_COD);

        // Cria um array com todos os dados da ocorrência
        $ocorrencia = [
          'protocolo'       => $ocorrencia_bd->OCORRENCIA_COD,
          'tipo'            => $ocorrencia_bd->tipo->TP_OCORRENCIA_NOME,
          'tipo_cod'        => $ocorrencia_bd->TP_OCORRENCIA_COD,
          'responsavel'     => $responsavel,
          'data'            => date('d/m/Y', strtotime($ocorrencia_bd->OCORRENCIA_DATA)),
          'endereco'        => $endereco_ocorrencia,
          'descricao'       => $ocorrencia_bd->OCORRENCIA_DESC,
          'envolvidos'      => $envolvidos,
          'objetos'         => $objetos,
          'atendimentos'    => $atendimentos,
          'latitude'        => $ocorrencia_bd->OCORRENCIA_LAT,
          'longitude'       => $ocorrencia_bd->OCORRENCIA_LONG
        ];

        // Retorna o array com os dados obtidos
        return $ocorrencia;
      } else {
        return null;
      }
    }

    /**
     * Busca no banco uma ocorrência informada e retorna um array com os dados dela para serem exibidos no mapa
     */
    public function getMapOcorrenciaData($id)
    {
      // Acessa o Banco e busca o ocorrência solicitada
      $ocorrencia_bd = Ocorrencia::find($id);
      // Se encontrar a ocorrência
      if($ocorrencia_bd == true) {
        // Cria a instância do Controller de Localizacao
        $localizacaoController = new LocalizacaoController();
        // Executa a function addressMount() e obtem uma string com o endereço da ocorrência
        $endereco_ocorrencia = $localizacaoController->addressMount(
          (($ocorrencia_bd->TP_LOGRADOURO_COD != null) ? $ocorrencia_bd->tipo_logradouro->TP_LOGRADOURO_NOME : ''),
          $ocorrencia_bd->OCORRENCIA_LOGRADOURO,
          $ocorrencia_bd->OCORRENCIA_NUM_LOCAL,
          $ocorrencia_bd->OCORRENCIA_BAIRRO,
          $ocorrencia_bd->municipio->MUNICIPIO_NOME,
          $ocorrencia_bd->OCORRENCIA_CEP,
          $ocorrencia_bd->OCORRENCIA_COMPLEMENTO_LOCAL
        );

        // Cria um array com todos os dados da ocorrência
        $ocorrencia = [
          'tipo'            => Tp_Ocorrencia::find($ocorrencia_bd->TP_OCORRENCIA_COD)->TP_OCORRENCIA_NOME,
          'data'            => date('d/m/Y', strtotime($ocorrencia_bd->OCORRENCIA_DATA)),
          'endereco'        => $endereco_ocorrencia,
          'latitude'        => $ocorrencia_bd->OCORRENCIA_LAT,
          'longitude'       => $ocorrencia_bd->OCORRENCIA_LONG
        ];

        // Retorna o array com os dados obtidos
        return $ocorrencia;
      } else {
        return null;
      }
    }

    /**
     * Cria um array com todas as ocorrências registradas
     */
    public function getOcorrencias()
    {
      // Acessa o Banco e busca todas as ocorrências cadastradas
      $ocorrencias_bd = Ocorrencia::all();
      // Cria o array que irá armazenas as ocorrências
      $ocorrencias = array();
      // Para cada ocorrência encontrada
      foreach($ocorrencias_bd as $ocorrencia) {
        // Executa a function getOcorrenciaData() para obter os dados
        $ocorrencia_data = $this->getOcorrenciaData($ocorrencia->OCORRENCIA_COD);
        // Faz a inserção dos dados da ocorrência no array de ocorrências
        array_push($ocorrencias, $ocorrencia_data);
      }
      // Retorna o array com todas as ocorrências
      return $ocorrencias;
    }
}
