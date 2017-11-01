<?php

namespace OcorrenciaOnline\Http\Controllers\Localizacao;

//Nativos
use Auth;
use DB;
use Redirect;
use Request;
// Models
use OcorrenciaOnline\Municipio;
// Controllers
use OcorrenciaOnline\Http\Controllers\Controller;
use OcorrenciaOnline\Http\Controllers\Usuario\UsuarioController;
use OcorrenciaOnline\Http\Controllers\Ocorrencia\OcorrenciaController;
// Requests
Use OcorrenciaOnline\Http\Requests\MapaDoCrimeRequest;


class LocalizacaoController extends Controller
{

  /**
   * Retorna para o usuário a view com o mapa do crime inicial
   */
  public function index()
  {
    // Retorna a view
    return view('Mapa/index-mapa');
  }

  /**
   * Retorna para o usuário a view com o mapa utilizando sua localização
   */
  public function showGeo()
  {
    // Define uma coordenada de base, para inicializar o mapa na tela.
    $coord_base = [
      'lat' => -20.3112878,
      'lng' => -40.3150777
    ];

    // Retorna a view
    return view('Mapa/geolocalizacao-mapa')
      ->with('coord_user', $coord_base); // As coordenadas base para a exibição do mapa
  }

  /**
   * Retorna para o usuário a view com o mapa utilizando sua localização
   */
  public function showEnd()
  {
    // Define uma coordenada de base, para inicializar o mapa na tela.
    $coord_base = [
      'lat' => -20.3112878,
      'lng' => -40.3150777
    ];
    // Retorna a view
    return view('Mapa/endereco-mapa')
      ->with('municipios', Municipio::all()) // Todos os municipios cadastrados no banco
      ->with('coord_user', $coord_base); // As coordenadas base para a exibição do mapa
  }

  /**
   * Retorna para o usuário a view com com a localização inserida na busca
   */
  public function showEndSearch(MapaDoCrimeRequest $request)
  {
    // Salvar em uma variavel a coordenada obtida através da function getCoordinates
    $localizacao_usuario = $this->getCoordinates(
      Municipio::find($request['endereco_municipio'])->MUNICIPIO_NOME,
      $request['endereco_cep'],
      $request['endereco_rua'],
      $request['endereco_numero'],
      $request['endereco_bairro']
    );
    // Armazena os dados inseridos nos campos do form na sessão, para poder popular o campo depois da busca
    $request->flash();
    // Cria um arrai com os dados de localização do usuário
    $coord_user = [
      'lat' => $localizacao_usuario['latitude'],
      'lng' => $localizacao_usuario['longitude']
    ];
    // Retorna para a view do mapa do crime com os dados de todos os municipios, as coordenadas novas, e as ocorrências próximo ao local.
    return view('Mapa/endereco-mapa')
      ->with('municipios', Municipio::all())
      ->with('coord_user', $coord_user);
  }

  /**
   * Busca todas as ocorrências nas proximidades de uma latitude e longitude recebida via GET por AJAX
   */
  public function searchProx() {
    // Verifica se o acesso está sendo feito via AJAX
    if(!Request::ajax()) {
      // Se não for é feito redirecionamento para tela anterior com uma mensagem de erro
      return Redirect::back()
            ->with('mensagem_erro', 'Não foi possível atender a sua requisição.');
    } else {
      // Pega as coordenadas que estão sendo recebidas pelo GET
      $lat = $_GET["lat"];
      $lng = $_GET["lng"];
      // Distância da busca
      $km = 0.3;
      // Query que realiza a busca das ocorrências em um raio aproximado ao informado e retorna os resultados
      $resultados = DB::select('
        SELECT * FROM ocorrencias WHERE
        OCORRENCIA_LAT BETWEEN ('.$lat.' - ('.$km.'*0.0072)) AND ('.$lat.' + ('.$km.'*0.0072)) AND
        OCORRENCIA_LONG BETWEEN ('.$lng.' - ('.$km.'*0.0072)) AND ('.$lng.' + ('.$km.'*0.0072));
      ');
      // Verifica se foram encontradas ocorrências
      if($resultados != null) {
        // Instância do Controller de Ocorrencias
        $ocorrenciaController = new OcorrenciaController;
        // Array que recebera todas as ocorrências encontradas
        $ocorrencias = Array();
        // Percorre todos os registros encontrados
        foreach($resultados as $resultado) {
          // Para cada ocorrência encontrado é executada a function que monta os dados de uma ocorrência
          $ocorrencia = $ocorrenciaController->getMapOcorrenciaData($resultado->OCORRENCIA_COD);
          // Insere a ocorrência no array
          array_push($ocorrencias, $ocorrencia);
        }
        // Retorna o array de ocorrências
        return response()->json([
          'ocorrencias' => $ocorrencias,
          'success' => 'yes',
        ]);
      } else {
        // Se não encontrar ocorrências é retornado null
        return null;
      }
    }
  }

  /**
   * Recebe os dados de um endereço e retorna a latitude e longitude conforme o Google
   */
  public function getCoordinates($cidade, $cep, $rua, $numero, $bairro)
  {
    // Variavel que irá receber o endereço que será processado pelo Google
    $endereco = '';
    // Popula a variavel com os dados de endereço que foram recebidos
    if($cidade != null) {
      $endereco .= $cidade;
    }
    if($cep != null) {
      $endereco .= ' '.$cep;
    }
    if($rua != null) {
      $endereco .= ' '.$rua;
    }
    if($numero != null) {
      $endereco .= ' '.$numero;
    }
    if($bairro != null) {
      $endereco .= ' '.$bairro;
    }
    // Remove espaços e adiciona um traço no lugar deles
    $endereco = preg_replace('/\s+/', '-', $endereco);
    // Define o contexto para o file_get_contents. O Contexto é necessário para que o file_get_contents não busque por cidades de outro país/lingua
    $opts = [
      "http" => [
          "method" => "GET",
          "header" => "Accept-language: pt-br\r\n" . "Cookie: foo=bar\r\n"
      ]
    ];
    // Cria o contexto para o file_get_contents
    $context = stream_context_create($opts);
    // Acessa a URL da API do Google Maps informando o endereço
    $url = ("https://maps.googleapis.com/maps/api/geocode/json?address=". $endereco ."&region=br&key=AIzaSyCpIlg5JuueIP6m7fp2cYHuXiQkruHQxF4");
    // Popula a variavel $json_retorno com os dados obtidos da API do Google Maps
    $json_retorno = json_decode(file_get_contents($url, false, $context), true);
    // Preenche o array com os dados da coordenada
    $coordenadas = [
      'latitude'        => $json_retorno['results'][0]['geometry']['location']['lat'],
      'longitude'       => $json_retorno['results'][0]['geometry']['location']['lng']
    ];
    // Retorna somente o array das coordenadas
    return $coordenadas;
  }

  /**
   * Recebe os dados de um endereço em forma de variável e monta um endereço completo e retorna em forma de string
   */
  public function addressMount($tp_logradouro, $logradouro, $numero, $bairro, $cidade, $cep, $complemento)
  {
    // Variavel que irá receber o endereço que será processado pelo Google
    $endereco = '';
    // Popula a variavel com os dados de endereço que foram recebidos
    if($tp_logradouro != null) {
      $endereco .= $tp_logradouro;
    }
    if($logradouro != null) {
      $endereco .= ' '.$logradouro;
    }
    if($numero != null) {
      $endereco .= ', '.$numero;
    }
    if($bairro != null) {
      $endereco .= ' - '.$bairro;
    }
    if($cidade != null) {
      $endereco .= ' - '.$cidade;
    }
    if($cep != null) {
      $endereco .= ' / '.$cep;
    }
    if($complemento != null) {
      $endereco .= ' - ('.$complemento.')';
    }
    // Retorna o endereço montado
    return $endereco;
  }

}
