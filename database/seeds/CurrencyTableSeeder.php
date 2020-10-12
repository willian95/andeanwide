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
            'country_id'        => 45,
            'name'              => 'Euro',
            'symbol'            => 'EUR',
            'more_country_id'   => '49',
            'more_city_id'      => '428'
        ]);

        Currency::create([
            'country_id'        => 28,
            'name'              => 'Chilean Peso',
            'symbol'            => 'CLP',
            'more_country_id'   => '56',
            'more_city_id'      => '12666'
        ]);

        Currency::create([
            'country_id'        => 30,
            'name'              => 'Colombiar Peso',
            'symbol'            => 'COP',
            'more_country_id'   => '57',
            'more_city_id'      => '189'
        ]);

        Currency::create([
            'country_id'        => 155,
            'name'              => 'Venezuelan Bolivar',
            'symbol'            => 'VEF',
            'can_send'          => false,
            'more_country_id'   => null,
            'more_city_id'      => null
        ]);

        Currency::create([
            'country_id'        => 151,
            'name'              => 'US Dollar',
            'symbol'            => 'USD',
            'can_send'          => true,
            'more_country_id'   => null,
            'more_city_id'      => null
        ]);
            
        Currency::create([
            'country_id'        => 118,
            'name'              => 'Peruvian Nuevo Sol',
            'symbol'            => 'PEN',
            'can_send'          => true,
            'more_country_id'   => 51,
            'more_city_id'      => 53
        ]);

        Currency::create([
            'country_id'        => 60,
            'name'              => 'Haitian Gourde',
            'symbol'            => 'HTG',
            'can_send'          => true,
            'more_country_id'   => 509,
            'more_city_id'      => 724
        ]);

        Currency::create([
            'country_id'        => 39,
            'name'              => 'Dominican Republic',
            'symbol'            => 'DOP',
            'can_send'          => true,
            'more_country_id'   => 1809,
            'more_city_id'      => 569
        ]);

        Currency::create([
            'country_id'        => 20,
            'name'              => 'Bolivia',
            'symbol'            => 'BOB',
            'can_send'          => true,
            'more_country_id'   => 591,
            'more_city_id'      => 16
        ]);
    }
}
