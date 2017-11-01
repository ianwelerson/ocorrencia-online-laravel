<?php

namespace OcorrenciaOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnvolvidoOcorrenciaRequest extends FormRequest
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
         'tp_envolvimento_cod'              => 'required|max:2',
         'envolvido_nome'                   => 'required|min:3|max:70',
         'envolvido_identidade'             => 'required|min:4|max:7',
         'envolvido_cpf'                    => 'nullable|digits:11',
         'envolvido_dt_nasci'               => 'nullable|date',
         'envolvido_nome_mae'               => 'nullable|min:3|max:70',
         'envolvido_tel_cel'                => 'nullable|digits:11',
         'municipio_cod'                    => 'nullable|max:2',
         'tp_logradouro_cod'                => 'nullable|max:2',
         'envolvido_logradouro'             => 'nullable',
         'envolvido_numero_res'             => 'nullable|numeric',
         'envolvido_complemento_res'        => 'nullable',
         'envolvido_bairro'                 => 'nullable',
         'envolvido_cep'                    => 'nullable|numeric'
       ];
   }

   /**
    * Mensagens de erro para cada tipo de validação
    */
   public function messages() {
     return [
       'required'  => 'O preenchimento deste campo é obrigatório!',
       'min'       => 'Este campo precisa de no mínimo :min caracteres',
       'max'       => 'O número de caracteres máximo neste campo é :max',
       'numeric'   => 'Deve ser utilizado apenas números neste campo',
       'digits'    => 'Este campo deve ter :digits digitos',
       'date'      => 'Deve ser utilizado um formato de data neste campo'
     ];
   }
}
