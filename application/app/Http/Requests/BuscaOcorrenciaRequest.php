<?php

namespace OcorrenciaOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscaOcorrenciaRequest extends FormRequest
{
  /**
   * Determina se um usuário está autorizado a executar essa request.
   */
  public function authorize()
  {
      return true;
  }

  /**
   * Realiza a validação da request e retorna o array com as informações da request
   */
  public function rules()
  {
    return [
      'busca_ocorrencia'  => 'nullable|numeric'
    ];
  }

  /**
   * Mensagens de erro para cada tipo de validação
   */
  public function messages() {
    return [
      'numeric'   => 'Deve ser utilizado apenas números neste campo'
    ];
  }
}
