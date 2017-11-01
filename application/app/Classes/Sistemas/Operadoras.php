<?php

namespace OcorrenciaOnline\Classes\Sistemas;

// Nativos
use URL;
// Models
use OcorrenciaOnline\Usuario;

class Operadoras
{
  public function checkData($id, $nome, $cpf, $telefone) {
    // Acessa a URL do arquivo com os dados da operadora
    $url = url('storage/base_teste/sistema_operadora.json');
    // Popula a variavel $json_retorno com os dados obtidos do arquivo Json
    $json_retorno = json_decode(file_get_contents($url), true);
    // Para cada registro no JSON..
    foreach($json_retorno as $registro) {
      // Verifica se todos os dados batem com os dados recebidos na funciton
      if(($registro['telefone'] == $telefone) && ($registro['nome'] == $nome) && ($registro['cpf'] == $cpf)) {
        // Se os dados forem todos iguais é feito a alteração do status de aprovação para true
        $usuario = Usuario::find($id);
        $usuario->USUARIO_AP_OPERADORA = true;
        $usuario->save();
        // O break é para parar a execução quando encontrar
        break;
      }
    }
  }
}
