<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Tp_Envolvimento extends Model
{

  //Define o nome da tabela
  protected $table = 'tp_envolvimento';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'TP_ENVOLVIMENTO_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'TP_ENVOLVIMENTO_COD', //É autoincrement no próprio banco e não precisa ser passada
    'TP_ENVOLVIMENTO_NOME',
    'TP_ENVOLVIMENTO_DESC'
  ];
}
