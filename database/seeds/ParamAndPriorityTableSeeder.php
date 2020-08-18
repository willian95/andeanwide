<?php

use App\Param;
use App\Priority;
use Illuminate\Database\Seeder;

class ParamAndPriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Param::create([
            'name'                  => 'Configuración',
            'description'           => 'Configuración por defecto',
            'transactionCostPct'    => 1,
            'taxPct'                => 19,
        ]);

        Priority::create([
            'name'          => 'normal',
            'description'   => 'Prioridad normal (Efectivo en 3 días hábiles)',
            'label'         => 'Normal',
            'sublabel'      => '3 días hábiles',
            'costPct'       => 0
        ]);

        Priority::create([
            'name'          => 'high',
            'description'   => 'Prioridad Alta (Efectivo el mismo día)',
            'label'         => 'Alta',
            'sublabel'      => 'Mismo día',
            'costPct'       => 5
        ]);
    }
}
