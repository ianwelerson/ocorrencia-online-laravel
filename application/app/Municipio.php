<?php

namespace OcorrenciaOnline;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
  //Define o nome da tabela
  protected $table = 'municipios';

  //Define qual o nome da chave primaria
  protected $primaryKey = 'MUNICIPIO_COD';

  //Elimina as colunas de data adicionadas automaticamente pelo Laravel
  public $timestamps = false;

  //Atributos que o modelo pode receber e passar para o banco.
  protected $fillable = [
    //'MUNICIPIO_COD', //É autoincrement no próprio banco e não precisa ser passada
    'MUNICIPIO_NOME',
    'MUNICIPIO_GV',
    'MUNICIPIO_UF'
  ];
}
