<?php

use Illuminate\Database\Seeder;

class Tp_LogradouroSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tp_logradouro')->insert([
          'tp_logradouro_nome' => 'Rua'
        ]);
        DB::table('tp_logradouro')->insert([
          'tp_logradouro_nome' => 'Avenida'
        ]);
        DB::table('tp_logradouro')->insert([
          'tp_logradouro_nome' => 'Viela'
        ]);
    }
}
