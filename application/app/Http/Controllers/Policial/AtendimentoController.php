<?php

namespace OcorrenciaOnline\Http\Controllers\Policial;

// Nativos
use Session;
use URL;
// Controllers
use OcorrenciaOnline\Http\Controllers\Controller;
use OcorrenciaOnline\Http\Controllers\Ocorrencia\OcorrenciaController;
// Models
use OcorrenciaOnline\Atendimento;
use OcorrenciaOnline\Ocorrencia;
use OcorrenciaOnline\Policial_Civil;
// Requests
use OcorrenciaOnline\Http\Requests\BuscaOcorrenciaRequest;
use OcorrenciaOnline\Http\Requests\AtendimentoOcorrenciaRequest;

class AtendimentoController extends Controller
{

  /**
   * Exibe uma lista de ocorrencias cadastradas em todo o sistema para o policial
   */
    public function index()
    {
      // Crima uma instância do Controller de Ocorrência, para poder acessar as functions que estão nele.
      $ocorrenciaController = new OcorrenciaController;

      // Retorna a view que lista as ocorrências passando todas as ocorrências registradas
      return view('Policial/ListaOcorrencias')
        ->with('ocorrencias', $ocorrenciaController->getOcorrencias()); // Executa a function getOcorrencias da instância do controller de Ocorrência.
    }

    /**
     * Realiza a busca por uma ocorrência especifica
     */
    public function search(BuscaOcorrenciaRequest $request) {

      // Verifica a request está vazia, pois se estiver é para retornar todas as ocorrências, se não irá realizar a busca.
      if($request['busca_ocorrencia'] != '') {
        // Busca na tabela de ocorrências uma ocorrência que tenha o código igual ao código informado na busca
        $busca_ocorrencias = Ocorrencia::where('OCORRENCIA_COD', $request['busca_ocorrencia'])->get();
        // Cria uma instância do Controller de Ocorrencia
        $ocorrenciaController = new OcorrenciaController();
        // Cria um array que irá receber as ocorrências
        $ocorrencias = array();
        // Percorre todas as ocorrências encontradas
        foreach($busca_ocorrencias as $ocorrencia) {
          // Para cada ocorrência, ele executa a function getOcorrenciaData() do Controller Ocorrencia, para obter os dados da ocorrência
          $ocorrencia_data = $ocorrenciaController->getOcorrenciaData($ocorrencia->OCORRENCIA_COD);
          // Insere os dados obtidos no array de ocorrências
          array_push($ocorrencias, $ocorrencia_data);
        }
        // Salva na request os dados da busca, para poder preencher o campo depois da busca
        $request->flash();
        // Retorna para a view de listar as ocorrências, passando o array de ocorrências
        return view('Policial/ListaOcorrencias')
          ->with('ocorrencias', $ocorrencias);
      } else {
        // Caso o campo de busca do form esteja em branco é retornado a function index() para exibir todas as ocorrências
        return $this->index();
      }
    }

    /**
     * Exibe os dados de uma ocorrência especifica
     */
    public function show($id) {
      // Cria uma instância do Controller de Ocorrencia
      $ocorrenciaController = new OcorrenciaController();
      // Retorna para a view que exibe as informações da ocorrência, passando o retorno da function getOcorrenciaData() do controller da Ocorrencia
      return view('Policial/ExibicaoOcorrencia')
      ->with('ocorrencia', $ocorrenciaController->getOcorrenciaData($id));
    }

    /**
     * Exibe as informações da ocorrência com um form para cadastrar o atendimento
     */
    public function create($id)
    {
      // Cria uma instância do Controller de Ocorrencia
      $ocorrenciaController = new OcorrenciaController();
      // Retorna a view de atendimento, passando o retorno da function getOcorrenciaData() do controller da Ocorrencia
      return view('Policial/AtendimentoOcorrencia')
        ->with('ocorrencia', $ocorrenciaController->getOcorrenciaData($id))
        ->with('policiais', Policial_Civil::all());
    }

    /**
     * Recebe os dados da request proveniente da view de atendimento e armazena eles no banco
     */
    public function store(AtendimentoOcorrenciaRequest $request)
    {
      // Cria uma instância do Controller de Ocorrencia
      $ocorrenciaController = new OcorrenciaController();
      // Verifica se a ocorrência recebida na request existe no banco, se existir pressegue com o armazenamento
      if(Ocorrencia::find($request['ocorrencia_atendimento']) == true) {
        // Cria um registro na tabela de atendimentos com os dados do atendimento
        Atendimento::create([
          'OCORRENCIA_COD'              => $request['ocorrencia_atendimento'],
          'POLICIAL_CIVIL_MATRICULA'    => $request['policial_atendimento'],
          'ATENDIMENTO_DATA'            => $request['data_atendimento'],
          'ATENDIMENTO_DESC'            => $request['descricao_atendimento']
        ]);
        // Redireciona para a ocorrência atendida, passando os dados dela que são recebidos como retorno na function getOcorrenciaData(), e passa a mensagem de atendimento cadastrado
        return Redirect('/policial/informacoes-ocorrencia/'.$request['ocorrencia_atendimento'])
          ->with('ocorrencia', $ocorrenciaController->getOcorrenciaData($request['ocorrencia_atendimento']))
          ->with('mensagem_sucesso', 'Atendimento cadastrado com sucesso!');
      } else {
        // Casso a ocorrência informada na request não exista

        // Armazena os dados informados de atendimento na sessão
        $request->flash();
        // Retorna para a tela de cadastrar atendimento, com uma mensagem de erro
        return Redirect(URL::previous())
          ->with('mensagem_erro', 'Houve um erro, tente novamente!');

      }
    }

    /**
     * Busca no banco todos os atendimentos de uma ocorrência
     */
    public function getAttend($ocorrencia_id) {
      // Realiza a busca no banco por atendimento de uma ocorrência, utilizando o ID
      $atendimento_bd = Atendimento::where('OCORRENCIA_COD', $ocorrencia_id)->get();
      // Cria um array de atendimentos
      $atendimentos = array();
      // Para cada atendimento...
      foreach($atendimento_bd as $atendimento) {
        // Busca o nome do policial responsável no banco
        $responsavel = Policial_Civil::find($atendimento->POLICIAL_CIVIL_MATRICULA);
        // Cria o array com os dados do atendimento
        $atendimento_Data = [
          'responsavel'     => $responsavel->POLICIAL_CIVIL_NOME,
          'data'            => date('d/m/Y', strtotime($atendimento->ATENDIMENTO_DATA)),
          'descricao'       => $atendimento->ATENDIMENTO_DESC,
        ];
        // Insere o atendimento no array dos atendimentos
        array_push($atendimentos, $atendimento_Data);
      }
      // Retorna o array de atendimentos
      return $atendimentos;
    }
}
