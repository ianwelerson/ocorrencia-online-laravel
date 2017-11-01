<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{

  //Define o nome da tabela
  protected $table = 'atendimentos';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'ATENDIMENTO_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'ATENDIMENTO_COD', //É autoincrement no próprio banco e não precisa ser passada
    'OCORRENCIA_COD',
    'POLICIAL_CIVIL_MATRICULA',
    'ATENDIMENTO_DATA',
    'ATENDIMENTO_DESC'
  ];
}
