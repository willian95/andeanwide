<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Account::class)->create([
            'country_id'    => 28,
            'currency_id'   => 2,
        ]);

        factory(App\Account::class)->create([
            'country_id'    => 28,
            'currency_id'   => 2,
        ]);

        factory(App\Account::class)->create([
            'country_id'    => 30,
            'currency_id'   => 3,
        ]);

        factory(App\Account::class)->create([
            'country_id'    => 30,
            'currency_id'   => 3,
        ]);

        factory(App\Account::class)->create([
            'country_id'    => 44,
            'currency_id'   => 1,
        ]);

        factory(App\Account::class)->create([
            'country_id'    => 44,
            'currency_id'   => 1,
        ]);

        factory(App\Account::class)->create([
            'country_id'    => 44,
            'currency_id'   => 1,
        ]);
    }
}
