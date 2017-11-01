<?php

namespace OcorrenciaOnline\Classes\Sistemas;

// Nativos
use URL;
// Models
Use OcorrenciaOnline\Usuario;

class IdentificacaoCivil
{
  public function checkData($id, $nome, $identidade, $nome_da_mae, $dt_nascimento) {
    // Acessa a URL do arquivo com os dados do Sistema de Identificação Civil
    $url = url('storage/base_teste/sistema_identificacao_civil.json');
    // Popula a variavel $json_retorno com os dados obtidos do arquivo Json
    $json_retorno = json_decode(file_get_contents($url), true);
    // Para cada registro no JSON..
    foreach($json_retorno as $registro) {
      // Verifica se todos os dados batem com os dados recebidos na funciton
      if(($registro['nome'] == $nome) && ($registro['rg'] == $identidade) && ($registro['nome_mae'] == $nome_da_mae) && ($registro['dt_nascimento'] == $dt_nascimento)) {
        // Se os dados forem todos iguais é feito a alteração do status de aprovação para true
        $usuario = Usuario::find($id);
        $usuario->USUARIO_AP_SIC = true;
        $usuario->save();
        // O break é para parar a execução quando encontrar
        break;
      }
    }
  }
}
