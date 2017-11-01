<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Tp_Logradouro extends Model
{

  //Define o nome da tabela
  protected $table = 'tp_logradouro';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'TP_LOGRADOURO_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'TP_LOGRADOURO_COD', //É autoincrement no próprio banco e não precisa ser passada
    'TP_LOGRADOURO_NOME'
  ];
}
