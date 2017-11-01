<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MunicipiosSeed::class);
        $this->call(Policial_CivilSeed::class);
        $this->call(Tp_LogradouroSeed::class);
        $this->call(Tp_OcorrenciaSeed::class);
        $this->call(Tp_ObjetoSeed::class);
        $this->call(Tp_EnvolvimentoSeed::class);
        $this->call(Un_MedidaSeed::class);
    }
}
