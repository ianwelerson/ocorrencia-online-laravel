<?php

use Illuminate\Database\Seeder;

class Tp_ObjetoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tp_objeto')->insert([
          'tp_objeto_nome' => 'Telefone Celular'
        ]);
        DB::table('tp_objeto')->insert([
          'tp_objeto_nome' => 'Notebook'
        ]);
        DB::table('tp_objeto')->insert([
          'tp_objeto_nome' => 'Veículo'
        ]);
        DB::table('tp_objeto')->insert([
          'tp_objeto_nome' => 'Bicicleta'
        ]);
        DB::table('tp_objeto')->insert([
          'tp_objeto_nome' => 'Documento'
        ]);
    }
}
