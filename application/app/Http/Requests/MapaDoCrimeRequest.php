<?php

namespace OcorrenciaOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapaDoCrimeRequest extends FormRequest
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
       'endereco_municipio'       => 'required|numeric',
       'endereco_cep'             => 'nullable|numeric|digits:8',
       'endereco_rua'             => 'nullable|required_with:endereco_numero',
       'endereco_numero'          => 'nullable|numeric|required_with:endereco_rua',
       'endereco_bairro'          => 'nullable'
     ];
   }

   /**
    * Mensagens de erro para cada tipo de validação
    */
   public function messages() {
     return [
       'required'       => 'O preenchimento deste campo é obrigatório!',
       'digits'         => 'Este campo deve ter :digits números',
       'numeric'        => 'Deve ser utilizado apenas números neste campo',
       'required_with'  => 'É necessário preencher esse campo'
     ];
   }
}
