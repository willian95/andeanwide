<?php

use Illuminate\Database\Seeder;

class TasasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tasa::create(['origen' => 'CLP', 'destino' => 'EUR', 'dias2' => 2.9928]);
        App\Tasa::create(['origen' => 'EUR', 'destino' => 'CLP', 'dias2' => 2.9928]);
        App\Tasa::create(['origen' => 'CLP', 'destino' => 'COP', 'dias2' => 3.116]);
        App\Tasa::create(['origen' => 'COP', 'destino' => 'CLP', 'dias2' => 3.116]);
        App\Tasa::create(['origen' => 'CLP', 'destino' => 'VES', 'dias2' => 25]);
        App\Tasa::create(['origen' => 'COP', 'destino' => 'EUR', 'dias2' => 2.9928]);
        App\Tasa::create(['origen' => 'EUR', 'destino' => 'COP', 'dias2' => 2.9928]);
        App\Tasa::create(['origen' => 'COP', 'destino' => 'VES', 'dias2' => 25]);
        App\Tasa::create(['origen' => 'EUR', 'destino' => 'VES', 'dias2' => 25]);
    }
}
