<?php

namespace OcorrenciaOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroOcorrenciaRequest extends FormRequest
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
      //Ocorrencia
      'tp_ocorrencia_cod'             => 'required|numeric|max:10',
      'ocorrencia_data'               => 'required|date',
      'ocorrencia_desc'               => 'required|min:20',
      'ocorrencia_cep'                => 'nullable|numeric|digits:8',
      'ocorrencia_municipio_cod'      => 'required|numeric|max:10',
      'ocorrencia_tp_logradouro_cod'  => 'nullable|numeric|max:10',
      'ocorrencia_logradouro'         => 'nullable|required_with:ocorrencia_tp_logradouro_cod|max:255',
      'ocorrencia_num_local'          => 'nullable|numeric',
      'ocorrencia_complemento_local'  => 'nullable|max:255',
      'ocorrencia_bairro'             => 'nullable|max:128',
      //Objetos
      'tp_objeto_cod'                 => 'nullable|required_with:un_medida_cod,objeto_quant,objeto_desc|numeric|max:10',
      'un_medida_cod'                 => 'nullable|required_with:tp_objeto_cod|numeric|max:10',
      'objeto_quant'                  => 'nullable|required_with:tp_objeto_cod|nullable|numeric',
      'objeto_desc'                   => 'nullable|required_with:tp_objeto_cod',
      //Envolvidos
      'tp_envolvimento_cod'           => 'nullable|required_with:envolvido_nome,envolvido_indentidade,envolvido_municipio_cod|numeric|max:10',
      'envolvido_nome'                => 'nullable|required_with:tp_envolvimento_cod|max:255',
      'envolvido_dt_nasc'             => 'nullable|date',
      'envolvido_indentidade'         => 'nullable|required_with:tp_envolvimento_cod|numeric',
      'envolvido_cpf'                 => 'nullable|numeric|digits:11',
      'envolvido_nome_mae'            => 'nullable|max:255',
      'envolvido_tel_contato'         => 'nullable|numeric|digits:11',
      'envolvido_municipio_cod'       => 'nullable|required_with:tp_envolvimento_cod|numeric|max:10',
      'envolvido_tp_logradouro_cod'   => 'nullable|numeric|max:10',
      'envolvido_logradouro'          => 'nullable|required_with:envolvido_tp_logradouro_cod|max:255',
      'envolvido_num_res'             => 'nullable|numeric',
      'envolvido_comp_res'            => 'nullable|',
      'envolvido_bairro'              => 'nullable|max:128',
      'envolvido_cep'                 => 'nullable|numeric|digits:8'
    ];
  }

  /**
   * Mensagens de erro para cada tipo de validação
   */
  public function messages() {
    return [
      'required'          => 'O preenchimento deste campo é obrigatório',
      'min'               => 'Este campo precisa de no mínimo :min caracteres',
      'max'               => 'O número de caracteres máximo neste campo é :max',
      'numeric'           => 'Deve ser utilizado apenas números neste campo',
      'digits'            => 'Este campo deve ter :digits digitos',
      'date'              => 'Deve ser utilizado um formato de data neste campo',
      'required_with'     => 'É necessário preencher este campo para prosseguir'
    ];
  }
}
