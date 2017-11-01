<?php

namespace OcorrenciaOnline\Classes\Ocorrencia;

//Modelos
use OcorrenciaOnline\Envolvido;
use OcorrenciaOnline\Tp_Envolvimento;
use OcorrenciaOnline\Tp_Logradouro;
use OcorrenciaOnline\Municipio;
//Controllers
use OcorrenciaOnline\Http\Controllers\Localizacao\LocalizacaoController;


class Envolvidos
{
    /**
     * Armazena no banco de dados um envolvido em uma ocorrencia
     */
    public function store($envolvido)
    {
      // Armazena os dados no banco
      Envolvido::create([
        'OCORRENCIA_COD'            => $envolvido['ocorrencia_cod'],
        'TP_ENVOLVIMENTO_COD'       => $envolvido['tp_envolvimento_cod'],
        'ENVOLVIDO_NOME'            => $envolvido['envolvido_nome'],
        'ENVOLVIDO_DT_NASC'         => $envolvido['envolvido_dt_nasc'],
        'ENVOLVIDO_IDENTIDADE'     => $envolvido['envolvido_indentidade'],
        'ENVOLVIDO_CPF'             => $envolvido['envolvido_cpf'],
        'ENVOLVIDO_NOME_MAE'        => $envolvido['envolvido_nome_mae'],
        'ENVOLVIDO_TEL_CONTATO'     => $envolvido['envolvido_tel_contato'],
        'MUNICIPIO_COD'             => $envolvido['municipio_cod'],
        'TP_LOGRADOURO_COD'         => $envolvido['tp_logradouro_cod'],
        'ENVOLVIDO_LOGRADOURO'      => $envolvido['envolvido_logradouro'],
        'ENVOLVIDO_NUM_RES'         => $envolvido['envolvido_num_res'],
        'ENVOLVIDO_COMP_RES'        => $envolvido['envolvido_comp_res'],
        'ENVOLVIDO_BAIRRO'          => $envolvido['envolvido_bairro'],
        'ENVOLVIDO_CEP'             => $envolvido['envolvido_cep']
      ]);

      // Apenas uma mensagem de true
      return 'true';
    }

    /**
     * Retorna um array com os dados dos envolvidos
     */
    public function getEnvolvidosData($id)
    {
      // Cria uma instância do Controller de Localizacao
      $localizacaoController = new LocalizacaoController();
      // Realiza a busca por todos os envolvidos que pertencem a uma determinada ocorrência, com base no ID da ocorrência
      $envolvidos_bd = Envolvido::where('OCORRENCIA_COD', $id)->get();
      // Cria um array de Envolvidos
      $envolvidos = array();
      // Para cada envolvido é feito:
      foreach($envolvidos_bd as $envolvido_bd) {
        // Executado a funtion addressMount() para retornar uma string com o endereço
        $endereco = $localizacaoController->addressMount(
          (($envolvido_bd->TP_LOGRADOURO_COD != null) ? $envolvido_bd->tipo_logradouro->TP_LOGRADOURO_NOME : ''),
          $envolvido_bd->ENVOLVIDO_LOGRADOURO,
          $envolvido_bd->ENVOLVIDO_NUM_RES,
          $envolvido_bd->ENVOLVIDO_BAIRRO,
          $envolvido_bd->municipio->MUNICIPIO_NOME,
          $envolvido_bd->ENVOLVIDO_CEP,
          $envolvido_bd->ENVOLVIDO_COMP_RES
        );
        // Montagem do array com os dados de um envolvido
        $envolvido = [
          'tipo_envolvimento' => $envolvido_bd->tipo_envolvimento->TP_ENVOLVIMENTO_NOME,
          'nome'              => $envolvido_bd->ENVOLVIDO_NOME,
          'dt_nascimento'     => ($envolvido_bd->ENVOLVIDO_DT_NASC === null) ? 'Não informado' : date('d-m-Y', strtotime($envolvido_bd->ENVOLVIDO_DT_NASCI)),
          'identidade'        => ($envolvido_bd->ENVOLVIDO_IDENTIDADE === null) ? 'Não informado' : $envolvido_bd->ENVOLVIDO_IDENTIDADE,
          'cpf'               => ($envolvido_bd->ENVOLVIDO_CPF === null) ? 'Não informado' : $envolvido_bd->ENVOLVIDO_CPF,
          'nome_mae'          => ($envolvido_bd->ENVOLVIDO_NOME_MAE === null) ? 'Não informado' : $envolvido_bd->ENVOLVIDO_NOME_MAE,
          'celular'           => ($envolvido_bd->ENVOLVIDO_TEL_CONTATO === null) ? 'Não informado' : $envolvido_bd->ENVOLVIDO_TEL_CONTATO,
          'endereco'          => $endereco
        ];
        // Adiciona o array do envolvido no array de envolvidos
        array_push($envolvidos, $envolvido);
      }
      // Retorna o array de envolvidos
      return $envolvidos;
    }



}
