<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Policial_Civil extends Model
{

  //Define o nome da tabela
  protected $table = 'policial_civil';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'POLICIAL_CIVIL_MATRICULA';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'POLICIAL_CIVIL_MATRICULA', //É autoincrement no próprio banco e não precisa ser passada
    'POLICIAL_CIVIL_NOME'
  ];
}
