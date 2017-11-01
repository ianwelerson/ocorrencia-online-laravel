<?php

use Illuminate\Database\Seeder;

class MunicipiosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')->insert([
          'municipio_nome'  => 'Vitória',
          'municipio_gv'    => true,
          'municipio_uf'    => 'ES'
        ]);
        DB::table('municipios')->insert([
          'municipio_nome'  => 'Vila Velha',
          'municipio_gv'    => true,
          'municipio_uf'    => 'ES'
        ]);
        DB::table('municipios')->insert([
          'municipio_nome'  => 'Cariacica',
          'municipio_gv'    => true,
          'municipio_uf'    => 'ES'
        ]);
        DB::table('municipios')->insert([
          'municipio_nome'  => 'Serra',
          'municipio_gv'    => true,
          'municipio_uf'    => 'ES'
        ]);
        DB::table('municipios')->insert([
          'municipio_nome'  => 'Guarapari',
          'municipio_gv'    => true,
          'municipio_uf'    => 'ES'
        ]);
        DB::table('municipios')->insert([
          'municipio_nome'  => 'Viana',
          'municipio_gv'    => true,
          'municipio_uf'    => 'ES'
        ]);
        DB::table('municipios')->insert([
          'municipio_nome'  => 'Fundão',
          'municipio_gv'    => true,
          'municipio_uf'    => 'ES'
        ]);
    }
}
