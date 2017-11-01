<?php

namespace OcorrenciaOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtendimentoOcorrenciaRequest extends FormRequest
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
       'ocorrencia_atendimento'   => 'required|numeric',
       'data_atendimento'         => 'required|date',
       'descricao_atendimento'    => 'required',
       'policial_atendimento'     => 'required'
     ];
   }

   /**
    * Mensagens de erro para cada tipo de validação
    */
   public function messages() {
     return [
       'numeric'      => 'Deve ser utilizado apenas números neste campo',
       'required'     => 'Este campo é obrigatório',
       'date'         => 'Deve ser utilizado apenas datas neste campo'
     ];
   }
}
