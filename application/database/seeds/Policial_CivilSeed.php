<?php

use Illuminate\Database\Seeder;

class Policial_CivilSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policial_civil')->insert([
          'policial_civil_nome' => 'Bruno Nogueira'
        ]);
        DB::table('policial_civil')->insert([
          'policial_civil_nome' => 'Augusto Gomes'
        ]);
        DB::table('policial_civil')->insert([
          'policial_civil_nome' => 'Paulo Madeira'
        ]);
    }
}
