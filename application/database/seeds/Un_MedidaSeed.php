<?php

use Illuminate\Database\Seeder;

class Un_MedidaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('un_medida')->insert([
          'un_medida_nome' => 'Unidade'
        ]);
        DB::table('un_medida')->insert([
          'un_medida_nome' => 'Quilo'
        ]);
        DB::table('un_medida')->insert([
          'un_medida_nome' => 'Grama'
        ]);
        DB::table('un_medida')->insert([
          'un_medida_nome' => 'Metro'
        ]);
    }
}
