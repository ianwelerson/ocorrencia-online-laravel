<?php

use Illuminate\Database\Seeder;

class Tp_EnvolvimentoSeed extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('tp_envolvimento')->insert([
      'tp_envolvimento_nome'  => 'Testemunha',
      'tp_envolvimento_desc'  => 'Testemunha que presenciou os fatos'
    ]);
  }
}
