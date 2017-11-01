<?php

namespace OcorrenciaOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUsuarioRequest extends FormRequest
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
        'usuario_identidade'  => 'required|min:4|numeric',
        'usuario_senha'       => 'required|between:6,12'
      ];
  }

  /**
   * Mensagens de erro para cada tipo de validação
   */
  public function messages() {
    return [
      'required'  => 'O preenchimento deste campo é obrigatório!',
      'between'   => 'Este campo deve ter um valor entre :min e :max',
      'numeric'   => 'Deve ser utilizado apenas números neste campo',
    ];
  }
}
