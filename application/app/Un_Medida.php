<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Un_Medida extends Model
{

  //Define o nome da tabela
  protected $table = 'un_medida';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'UN_MEDIDA_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'UN_MEDIDA_COD', //É autoincrement no próprio banco e não precisa ser passada
    'UN_MEDIDA_NOME '
  ];
}
