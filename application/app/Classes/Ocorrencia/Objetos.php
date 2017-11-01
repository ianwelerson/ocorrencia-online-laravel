<?php

namespace OcorrenciaOnline\Classes\Ocorrencia;

//Modelos
use OcorrenciaOnline\Objeto;

class Objetos
{
    /**
     * Armazena no banco os dados referentes a um objeto envolvido em uma ocorrência
     */
    public function store($objetos)
    {
      // Armazena os dados do objeto
      Objeto::create([
        'OCORRENCIA_COD'    => $objetos['ocorrencia_cod'],
        'TP_OBJETO_COD'     => $objetos['tp_objeto_cod'],
        'UN_MEDIDA_COD'     => $objetos['un_medida_cod'],
        'OBJETO_QUANT'      => $objetos['objeto_quant'],
        'OBJETO_DESC'       => $objetos['objeto_desc']
      ]);
      // Retorno de um true
      return 'true';
    }

    /**
     * Retorna um array com os dados dos objetos.
     */
    public function getObjetosData($id)
    {
      // Busca no banco todos os objetos envolvidos em uma ocorrência utilizando o ID
      $objetos_bd = Objeto::where('OCORRENCIA_COD', $id)->get();
      // Cria um array para armazenar todos os objetos envolvidos
      $objetos = array();
      // Para cada objeto executa:
      foreach($objetos_bd as $objeto_bd) {
        // Cria o array com os dados de um objeto
        $objeto = [
          'tipo_objeto'   => $objeto_bd->tipo->TP_OBJETO_NOME,
          'un_medida'     => $objeto_bd->unidade->UN_MEDIDA_NOME,
          'quantidade'    => $objeto_bd->OBJETO_QUANT,
          'descricao'     => $objeto_bd->OBJETO_DESC
        ];
        // Insere no array de objetos o objeto
        array_push($objetos, $objeto);
      }
      // Retorna o array de objetos envolvidos
      return $objetos;
    }
}
