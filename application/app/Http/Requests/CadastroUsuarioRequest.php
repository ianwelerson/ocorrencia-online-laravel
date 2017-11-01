<?php

namespace OcorrenciaOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroUsuarioRequest extends FormRequest
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
        'usuario_nome'                  => 'required|between:3,70',
        'usuario_identidade'            => 'required|unique:usuarios,USUARIO_IDENTIDADE|numeric',
        'usuario_cpf'                   => 'required|unique:usuarios,USUARIO_CPF|digits:11',
        'usuario_dt_nasci'              => 'required|date',
        'usuario_nome_mae'              => 'required|between:3,70',
        'usuario_tel_cel'               => 'required|confirmed|digits:11',
        'usuario_email'                 => 'required|confirmed|email',
        'usuario_foto_rosto'            => 'required|image|max:4000',
        'usuario_foto_doc'              => 'required|image|max:4000',
        'municipio_cod'                 => 'required|max:2',
        'tp_logradouro_cod'             => 'required|max:2',
        'usuario_logradouro'            => 'required',
        'usuario_numero_res'            => 'required|numeric',
        'usuario_complemento_res'       => 'nullable',
        'usuario_bairro'                => 'required',
        'usuario_cep'                   => 'required|numeric',
        'usuario_senha'                 => 'required|confirmed|between:6,12',
      ];
  }

  /**
   * Mensagens de erro para cada tipo de validação
   */
  public function messages() {
    return [
      'required'  => 'O preenchimento deste campo é obrigatório',
      'min'       => 'Este campo precisa de no mínimo :min caracteres',
      'max'       => 'O tamanho máximo desse campo é :max',
      'numeric'   => 'Deve ser utilizado apenas números neste campo',
      'confirmed' => 'A informação neste campo deve ser igual ao do outro campo igual',
      'digits'    => 'Este campo deve ter :digits digitos',
      'email'     => 'Este campo deve ser um e-mail',
      'date'      => 'Deve ser utilizado um formato de data neste campo',
      'image'     => 'A imagem deve ser no formato JPG ou PNG',
      'between'   => 'Este campo deve ter entre :min e :max caracteres',
      'unique'    => 'Já existe um cadastro com esse documento no sistema',
    ];
  }
}
