<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesAndPermissionSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(AccountTableSeeder::class);
        $this->call(ParamAndPriorityTableSeeder::class);
        // $this->call(UserTableSeederWithClient::class);
        // $this->call(TasasSeeder::class);
    }
}
