<?php

use Illuminate\Database\Seeder;

class Tp_OcorrenciaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tp_ocorrencia')->insert([
          'tp_ocorrencia_nome'  => 'Roubo de Objeto',
          'tp_ocorrencia_desc'  => 'Aplica-se em casos onde o objeto é subtraído existindo ameaça/contato, mas há danos e/ou vítimas de lesão corporal ou morte.'
        ]);
        DB::table('tp_ocorrencia')->insert([
          'tp_ocorrencia_nome'  => 'Furto de Objeto',
          'tp_ocorrencia_desc'  => 'Aplica-se em casos onde o objeto é subtraído sem que haja ameaça/contato.'
        ]);
        DB::table('tp_ocorrencia')->insert([
          'tp_ocorrencia_nome'  => 'Perda de Documento',
          'tp_ocorrencia_desc'  => 'Aplica-se em casos onde o indívuo perdeu documentos.'
        ]);
    }
}
