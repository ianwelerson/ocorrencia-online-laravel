<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Usuario extends Model implements AuthenticatableContract
{
  use Authenticatable;

  //Define o nome da tabela
  protected $table = 'usuarios';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'USUARIO_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'USUARIO_COD', //É autoincrement no próprio banco e não precisa ser passada
    'MUNICIPIO_COD',
    'POLICIAL_CIVIL_MATRICULA',
    'USUARIO_NOME',
    'USUARIO_IDENTIDADE',
    'USUARIO_CPF',
    'USUARIO_DT_NASCI',
    'USUARIO_NOME_MAE',
    'USUARIO_TEL_CEL',
    'USUARIO_EMAIL',
    'USUARIO_FOTO_ROSTO',
    'USUARIO_FOTO_DOC',
    'TP_LOGRADOURO_COD',
    'USUARIO_LOGRADOURO',
    'USUARIO_NUMERO_RES',
    'USUARIO_COMPLEMENTO_RES',
    'USUARIO_BAIRRO',
    'USUARIO_CEP',
    'USUARIO_SENHA',
    'USUARIO_DT_REGISTRO',
    'USUARIO_DT_APROVADO',
    'USUARIO_AP_SIC',
    'USUARIO_AP_OPERADORA',
    'USUARIO_AP_FOTOS',
    'USUARIO_IP_REGISTRO'
  ];
  // Para que o laravel reconheça a coluna USUARIO_SENHA como senha do usuário
  public function getAuthPassword () {
    return $this->USUARIO_SENHA;
  }
  // Relacionamento entre a tabela de Usuario e Tipo de logradouro
  public function tipo_logradouro()
  {
    return $this->belongsTo('OcorrenciaOnline\Tp_Logradouro', 'TP_LOGRADOURO_COD');
  }

  // Relacionamento entre a tabela de Usuario e Municipio
  public function municipio()
  {
    return $this->belongsTo('OcorrenciaOnline\Municipio', 'MUNICIPIO_COD');
  }

}
