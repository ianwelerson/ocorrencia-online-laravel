<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{

  //Define o nome da tabela
  protected $table = 'ocorrencias';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'OCORRENCIA_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'OCORRENCIA_COD', //É autoincrement no próprio banco e não precisa ser passada
    'USUARIO_COD',
    'MUNICIPIO_COD',
    'TP_OCORRENCIA_COD',
    'OCORRENCIA_DATA',
    'OCORRENCIA_DESC',
    'TP_LOGRADOURO_COD',
    'OCORRENCIA_LOGRADOURO',
    'OCORRENCIA_NUM_LOCAL',
    'OCORRENCIA_COMPLEMENTO_LOCAL',
    'OCORRENCIA_BAIRRO',
    'OCORRENCIA_CEP',
    'OCORRENCIA_LAT',
    'OCORRENCIA_LONG',
    'OCORRENCIA_IP_REGISTRO'
  ];

  // Relacionamento entre a tabela de ocorrencias e tipos de ocorrencias
  public function tipo()
  {
    return $this->belongsTo('OcorrenciaOnline\Tp_Ocorrencia', 'TP_OCORRENCIA_COD');
  }

  // Relacionamento entre a tabela de ocorrencias e tipos de logradouro
  public function tipo_logradouro()
  {
    return $this->belongsTo('OcorrenciaOnline\Tp_Logradouro', 'TP_LOGRADOURO_COD');
  }


  // Relacionamento entre a tabela de ocorrencias e municipios
  public function municipio()
  {
    return $this->belongsTo('OcorrenciaOnline\Municipio', 'MUNICIPIO_COD');
  }

}
