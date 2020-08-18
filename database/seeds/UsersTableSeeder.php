<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'country_id'    => 28,
            'name'          => 'fieldyn',
            'lastname'      => 'xtreme',
            'email'         => 'fieldyn@gmail.com',
            'password'      => bcrypt('12345')
        ]);

        $user->markEmailAsVerified();

        $user = App\User::create([
            'country_id'    => 28,
            'name'          => 'Gregorio',
            'lastname'      => 'Fernandez',
            'email'         => 'jgfs81@gmail.com',
            'password'      => bcrypt('12345')
        ]);

        $user->markEmailAsVerified();
    }
}
