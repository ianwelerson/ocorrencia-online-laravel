<?php

namespace OcorrenciaOnline\Http\Controllers\Policial;

// Nativos
use URL;
// Modelos
use OcorrenciaOnline\Usuario;
use OcorrenciaOnline\Policial_Civil;
// Controllers
use OcorrenciaOnline\Http\Controllers\Controller;
use OcorrenciaOnline\Http\Controllers\Usuario\UsuarioController;
// Requests
use OcorrenciaOnline\Http\Requests\BuscaUsuarioRequest;

class GerenciarUsuarioController extends Controller
{
    /**
     * Exibe a tela principal da área de gerenciamento de usuários com todos os usuários cadastrados.
     */
    public function index()
    {
      // Cria uma instância do Controller de Usuários.
      $usuarioController = new UsuarioController();
      // Retorna a view de lista de usuários com um array de usuários obtidos através do método getUsers() do Controller de Usuários
      return view('Policial/ListaUsuarios')
        ->with('usuarios', $usuarioController->getUsers());
    }

    /**
     * Realiza a busca por um usuário e retorna na mesma view de listagem somente esse usuário
     */
    public function search(BuscaUsuarioRequest $request)
    {
      // Verifica se o campo informando a identidade do usuário está em branco na request, caso esteja realiza a busca
      if($request['busca_usuario'] != '') {
        // Realiza a busca na tabela de Usuários pelo usuário informado
        $busca_usuarios = Usuario::where('USUARIO_IDENTIDADE', $request['busca_usuario'])->get();
        // Cria uma instância do Controller de Usuários.
        $usuarioController = new UsuarioController();
        // Cria um array de usuários que será preenchido com os usuários encontrados
        $usuarios = array();

        foreach($busca_usuarios as $usuario) {
          // Para cada usuário executa a function getUserData() do Controller de Usuario e obtem os dados desse usuário
          $usuario_data = $usuarioController->getUserData($usuario->USUARIO_COD);
          //  Insere no array os dados desse usuário
          array_push($usuarios, $usuario_data);
        }
        // Armazena os dados da request na sessão, para poder popular os campos da busca
        $request->flash();
        // Retorna para a view de listagem de usuário com apenas o resultado da busca
        return view('Policial/ListaUsuarios')
          ->with('usuarios', $usuarios);
      } else {
        // Caso não tenha sido informado um usuário, é feito a execução da function index() que irá retornar todos os usuários
        return $this->index();
      }
    }

    /**
     * Exibe as informações de um usuário especifico
     */
    public function show($id)
    {
      // Cria uma instância do Controller de Usuários.
      $usuarioController = new UsuarioController();
      // Retorna a view com as informações do usuário, que são obtidas atraves da function getUserData() do controller de Usuarios
      return view('Policial/ExibicaoUsuario')
        ->with('usuario', $usuarioController->getUserData($id))
        ->with('policiais', Policial_Civil::all());
    }

    /**
     * Atualiza os dados do usuário no banco com as informações de aprovação do policial
     */
    public function approveUser($id)
    {
      // Realiza a busca pelo usuário informado no link
      $usuario = Usuario::find($id);
      // Se o usuários já existir e a coluna USUARIO_AP_FOTOS for false executa a aprovação
      if(($usuario == true) && ($usuario->USUARIO_AP_FOTOS == false) && ($usuario->USUARIO_AP_SIC == true) && ($usuario->USUARIO_AP_OPERADORA == true)) {
        // Preenche os campos do cadastro do usuário:
        $usuario->POLICIAL_CIVIL_MATRICULA  = $_GET['policial_aprovacao'];    // Matrícula do policial que realizou a aprovação
        $usuario->USUARIO_AP_FOTOS          = true;                           // Altera a aprovação das fotos para TRUE
        $usuario->USUARIO_DT_APROVADO       = date('Y-m-d H:i:s');            // Especifica a data que o usuário foi aprovado
        // Salva as alterações feitas
        $usuario->save();
        // Redireciona para a tela com as informações do usuário e com uma mensagem informado que ele foi aprovado
        return Redirect('/policial/informacoes-usuario/'.$id)
          ->with('mensagem_sucesso', 'Usuário aprovado com sucesso!');
      } else {
        // Caso o usuário não exista é feito um redirecionamento para a tela anterior com a mensagem de erro na provação.
        return Redirect(URL::previous())
          ->with('mensagem_erro', 'Não foi possível aprovar este usuário!');
      }
    }
}
