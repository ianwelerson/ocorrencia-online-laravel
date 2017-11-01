<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Envolvido extends Model
{

  //Define o nome da tabela
  protected $table = 'envolvidos';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'ENVOLVIDO_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'ENVOLVIDO_COD', //É autoincrement no próprio banco e não precisa ser passada
    'OCORRENCIA_COD',
    'TP_ENVOLVIMENTO_COD',
    'ENVOLVIDO_NOME',
    'ENVOLVIDO_DT_NASC',
    'ENVOLVIDO_IDENTIDADE',
    'ENVOLVIDO_CPF',
    'ENVOLVIDO_NOME_MAE',
    'ENVOLVIDO_TEL_CONTATO',
    'MUNICIPIO_COD',
    'TP_LOGRADOURO_COD',
    'ENVOLVIDO_LOGRADOURO',
    'ENVOLVIDO_NUM_RES',
    'ENVOLVIDO_COMP_RES',
    'ENVOLVIDO_BAIRRO',
    'ENVOLVIDO_CEP'
  ];


  // Relacionamento entre a tabela de Envolvido e tipo de envolvimento
  public function tipo_envolvimento()
  {
    return $this->belongsTo('OcorrenciaOnline\Tp_Envolvimento', 'TP_ENVOLVIMENTO_COD');
  }

  // Relacionamento entre a tabela de Envolvido e Tipo de logradouro
  public function tipo_logradouro()
  {
    return $this->belongsTo('OcorrenciaOnline\Tp_Logradouro', 'TP_LOGRADOURO_COD');
  }

  // Relacionamento entre a tabela de Envolvido e Municipio
  public function municipio()
  {
    return $this->belongsTo('OcorrenciaOnline\Municipio', 'MUNICIPIO_COD');
  }
}
