<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{

  //Define o nome da tabela
  protected $table = 'objetos';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'OBJETO_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'OBJETO_COD', //É autoincrement no próprio banco e não precisa ser passada
    'OCORRENCIA_COD',
    'TP_OBJETO_COD',
    'UN_MEDIDA_COD',
    'OBJETO_QUANT',
    'OBJETO_DESC'
  ];

  // Relacionamento entre a tabela de Objeto e tipos de objeto
  public function tipo()
  {
    return $this->belongsTo('OcorrenciaOnline\Tp_Objeto', 'TP_OBJETO_COD');
  }

  // Relacionamento entre a tabela de ocorrencias e unidade de medida
  public function unidade()
  {
    return $this->belongsTo('OcorrenciaOnline\Un_Medida', 'UN_MEDIDA_COD');
  }
}
