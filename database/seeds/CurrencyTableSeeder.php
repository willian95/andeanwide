<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Estonia
        Currency::create([
            'country_id'=> 44,
            'name'      => 'Euro',
            'symbol'    => 'EUR',
        ]);

        Currency::create([
            'country_id'=> 28,
            'name'      => 'Chilean Peso',
            'symbol'    => 'CLP',
        ]);

        Currency::create([
            'country_id'=> 30,
            'name'      => 'Colombiar Peso',
            'symbol'    => 'COP',
        ]);

        Currency::create([
            'country_id'=> 154,
            'name'      => 'Venezuelan Bolivar',
            'symbol'    => 'VEF',
            'can_send'  => false
        ]);

        Currency::create([
            'country_id'=> 150,
            'name'      => 'US Dollar',
            'symbol'    => 'USD',
            'can_send'  => true
        ]);
    }
}
