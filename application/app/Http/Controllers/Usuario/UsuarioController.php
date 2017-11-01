<?php

namespace OcorrenciaOnline\Http\Controllers\Usuario;

//Nativos
use Storage;
use Auth;
//Modelos
use OcorrenciaOnline\Usuario;
use OcorrenciaOnline\Tp_Logradouro;
use OcorrenciaOnline\Municipio;
use OcorrenciaOnline\Policial_Civil;
//Controllers
use OcorrenciaOnline\Http\Controllers\Controller;
use OcorrenciaOnline\Http\Controllers\Ocorrencia\OcorrenciaController;
use OcorrenciaOnline\Http\Controllers\Localizacao\LocalizacaoController;
//Requests
use OcorrenciaOnline\Http\Requests\CadastroUsuarioRequest;
use OcorrenciaOnline\Http\Requests\LoginUsuarioRequest;
// Classes
use OcorrenciaOnline\Classes\Sistemas\Operadoras;
use OcorrenciaOnline\Classes\Sistemas\IdentificacaoCivil;

class UsuarioController extends Controller
{

  /**
   * Exibe a página inicial do usuario
   */
  public function index()
  {
    // Cria uma instância do Controller de Ocorrencia
    $ocorrenciaController = new OcorrenciaController();
    // Obtem todas as ocorrências registradas por um mesmo usuário, utilizando como base o usuário logado
    $ocorrencias = $ocorrenciaController->getUserRegisters(Auth::user()->USUARIO_COD);
    // Retorna para a view Meu Cadastro, com as ocorrências registradas por ele
    return view('Usuario/cadastro-usuario')
            ->with('ocorrencias', $ocorrencias);
  }

  /**
   * Exibe o formulário de login
   */
  public function login()
  {
    // Retorna a view de Login
    return view('Usuario/login-usuario');
  }

  /**
   * Efetua a validação e login do usuário
   */
  public function acess(LoginUsuarioRequest $request)
  {
    // Verifica se os dados de IDENTIDADE e SENHA informados correspondem com algum presente no banco, caso exista é feito o redirecionamento
		if(Auth::attempt(['USUARIO_IDENTIDADE' =>  $request['usuario_identidade'], 'password'  =>  $request['usuario_senha']], true)) {
      // Redireciona o usuário para a tela de Meu Cadastro
			return Redirect('meu-cadastro');
		} else {
      // Caso os dados estejam incorretos é feito o redirecionamento para a tela de login com uma mensagem de erro
			return Redirect('acessar')
              ->with('mensagem_erro', 'Erro ao acessar: "Número da Identidade" ou "Senha" incorreto.');
		}
  }

  /**
   * Exibe o formulário de cadastro de um novo usuário
   */
  public function create()
  {
    // Retorna a view de Registro de Usuario, passando todos os tipos de logradouro e municipios cadastrados no banco
    return view('Usuario/novo-usuario')
      ->with('tp_logradouros', Tp_Logradouro::all())
      ->with('municipios', Municipio::all());
  }

  /**
   * Armazena no banco os dados do usuário que foram obtidos da request
   */
  public function store(CadastroUsuarioRequest $request)
  {
    // Passa para a function storeImage() o número da Identidade do usuários e as duas imagens enviadas no form, e recebe como retorno o nome que a imagem terá na pasta de armazenamento
    $foto_nome = $this->storeImage(
      $request['usuario_identidade'],
      $request->file('usuario_foto_rosto'),
      $request->file('usuario_foto_doc')
    );

    // Executa o criação do usuário no banco
    $novo_usuario = Usuario::create([
      'USUARIO_NOME'                => $request['usuario_nome'],
      'USUARIO_IDENTIDADE'          => $request['usuario_identidade'],
      'USUARIO_CPF'                 => $request['usuario_cpf'],
      'USUARIO_DT_NASCI'            => $request['usuario_dt_nasci'],
      'USUARIO_NOME_MAE'            => $request['usuario_nome_mae'],
      'USUARIO_TEL_CEL'             => $request['usuario_tel_cel'],
      'USUARIO_EMAIL'               => $request['usuario_email'],
      'USUARIO_FOTO_ROSTO'          => $foto_nome, //Armazena apenas o nome do arquivo da foto recebido do storeImage()
      'USUARIO_FOTO_DOC'            => $foto_nome, //Armazena apenas o nome do arquivo da foto recebido do storeImage()
      'MUNICIPIO_COD'               => $request['municipio_cod'],
      'TP_LOGRADOURO_COD'           => $request['tp_logradouro_cod'],
      'USUARIO_LOGRADOURO'          => $request['usuario_logradouro'],
      'USUARIO_NUMERO_RES'          => $request['usuario_numero_res'],
      'USUARIO_COMPLEMENTO_RES'     => $request['usuario_complemento_res'],
      'USUARIO_BAIRRO'              => $request['usuario_bairro'],
      'USUARIO_CEP'                 => $request['usuario_cep'],
      'USUARIO_SENHA'               => bcrypt($request['usuario_senha']), //Armazena a senha criptografada do usuário
      'USUARIO_DT_REGISTRO'         => date('Y-m-d H:i:s'), //Armazena a data e hora do momento do cadastro
      'USUARIO_IP_REGISTRO'         => $_SERVER['REMOTE_ADDR']
    ]);

    // Cria uma instância do Sistema de Operadora
    $operadora = new Operadoras();
    // Executa a function checkData() da Operadora passando os dados necessários
    $operadora->checkData($novo_usuario->USUARIO_COD, $novo_usuario->USUARIO_NOME, $novo_usuario->USUARIO_CPF, $novo_usuario->USUARIO_TEL_CEL);

    // Cria uma instância do Sistema de Identificação Civil
    $sic = new IdentificacaoCivil();
    // Executa a function checkData() da Identificação Civil passando os dados necessários
    $sic->checkData($novo_usuario->USUARIO_COD, $novo_usuario->USUARIO_NOME, $novo_usuario->USUARIO_IDENTIDADE, $novo_usuario->USUARIO_NOME_MAE, $novo_usuario->USUARIO_DT_NASCI);

    // Redireciona para a tela de login, com a mensagem de cadastro efetuado
    return redirect('/acessar')
      ->with('mensagem_sucesso', 'Seu cadastro foi efetuado, faça o acesso agora');
  }

  /**
   * Recebe um ID e monta um array com todos os dados desse usuário
   */
  public function getUserData($id)
  {
    // Busca o Usuário no banco
    $usuario_bd = Usuario::find($id);
    // Caso o usuário exista, executa a montagem das informações
    if($usuario_bd == true) {
      // Cria uma instância do Controller de Localização
      $localizacaoController = new LocalizacaoController();
      // Utiliza a function addressMount() para montar uma string com o endereço completo do usuário
      $endereco = $localizacaoController->addressMount(
        (($usuario_bd->TP_LOGRADOURO_COD != null) ? $usuario_bd->tipo_logradouro->TP_LOGRADOURO_NOME : ''),
        $usuario_bd->USUARIO_LOGRADOURO,
        $usuario_bd->USUARIO_NUMERO_RES,
        $usuario_bd->USUARIO_BAIRRO,
        $usuario_bd->municipio->MUNICIPIO_NOME,
        $usuario_bd->USUARIO_CEP,
        $usuario_bd->USUARIO_COMPLEMENTO_RES
      );
      // Verifica se existe os dados de Policial Civil no cadastro do usuário
      if($usuario_bd->POLICIAL_CIVIL_MATRICULA != null) {
        // Busca os dados do Policial Civil presente no cadastro usuário
        $policial_civil = Policial_Civil::find($usuario_bd->POLICIAL_CIVIL_MATRICULA);
        // Seta a variavel policial_civil com o nome do Policial
        $policial_civil = $policial_civil->POLICIAL_CIVIL_NOME;
      } else {
        // Se não existir policial civil no cadastro do usuário a variavel policial_civil recebe nullo
        $policial_civil = null;
      }

      // Cria o array com todos os dados do usuário
      $usuario = [
        'codigo'            => $usuario_bd->USUARIO_COD,
        'nome'              => $usuario_bd->USUARIO_NOME,
        'dt_nascimento'     => date('d/m/Y', strtotime($usuario_bd->USUARIO_DT_NASCI)),
        'identidade'        => $usuario_bd->USUARIO_IDENTIDADE,
        'cpf'               => $usuario_bd->USUARIO_CPF,
        'nome_mae'          => $usuario_bd->USUARIO_NOME_MAE,
        'celular'           => $usuario_bd->USUARIO_TEL_CEL,
        'email'             => $usuario_bd->USUARIO_EMAIL,
        'foto_rosto'        => $usuario_bd->USUARIO_FOTO_ROSTO,
        'foto_doc'          => $usuario_bd->USUARIO_FOTO_DOC,
        'endereco'          => $endereco,
        'dt_registro'       => $usuario_bd->USUARIO_DT_REGISTRO,
        'ap_sic'            => $usuario_bd->USUARIO_AP_SIC,
        'ap_operadora'      => $usuario_bd->USUARIO_AP_OPERADORA,
        'ap_fotos'          => $usuario_bd->USUARIO_AP_FOTOS,
        'dt_ap'             => $usuario_bd->USUARIO_DT_APROVADO,
        'pc_responsavel'    => $policial_civil
      ];
      // Retorna o array com os dados do usuário
      return $usuario;
    } else {
      // Retorna null
      return null;
    }
  }

  /**
   * Cria um array com todos os usuários registrados no sistema
   */
  public function getUsers()
  {
    // Busca todos os usuários existentes no banco
    $usuarios_bd = Usuario::all();
    // Cria um array que receberá os usuários
    $usuarios = array();
    // Executa o foreach com cada usuário obtido da consulta ao banco
    foreach($usuarios_bd as $usuario) {
      // Executa a function getUserData() passando o ID do usuário
      $usuario_data = $this->getUserData($usuario->USUARIO_COD);
      // Passa para o array de usuarios o usuario montado
      array_push($usuarios, $usuario_data);
    }
    // Retorna o array com os usuários
    return $usuarios;
  }


  /**
   * Armazena as imagens em suas respectivas pastas e retorna o nome do arquivo.
   */
  public function storeImage($identidade, $request_foto_rosto, $request_foto_doc) {

    //Define o nome da imagem, que será o número da identidade mais a extensão JPG
    $foto_nome = $identidade.'.jpg';

    // ---------- Para a foto de rosto ----------
    // Verifica se a imagem já existe na pasta
    if(Storage::exists('public/rosto/'.$foto_nome)) {
      // Se já existir ela será deletada
      Storage::delete('public/rosto/'.$foto_nome);
    }
    Storage::putFileAs('public/rosto', $request_foto_rosto, $foto_nome, 'public');

    // ---------- Para a foto do documento ----------
    // Verifica se a imagem já existe na pasta
    if(Storage::exists('public/documento/'.$foto_nome)) {
      // Se já existir ela será deletada
      Storage::delete('public/documento/'.$foto_nome);
      // Faz o upload da imagem para a pasta
    }
    Storage::putFileAs('public/documento', $request_foto_doc, $foto_nome, 'public');
    //retorna o nome final da imagem
    return $foto_nome;
  }

  /**
   * Desloga o usuário
   */
  public function logout() {
    // Executa o metodo para deslogar o usuário
    Auth::logout();
    // Retorna o usuário para tela inicial com a mensagem de deslogado
    return redirect('/acessar')->with('mensagem_sucesso', 'Você saiu do sistema');
  }
}
