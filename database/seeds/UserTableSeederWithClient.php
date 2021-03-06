<?php

use App\User;
use App\Address;
use App\Identity;
use Illuminate\Database\Seeder;

class UserTableSeederWithClient extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i=0; $i < 10; $i++) { 
        //     $user = factory(User::class)->create();
    
        //     $user->assignRole('user');
    
        //     $identity = factory(Identity::class)->create([
        //         'user_id'       => $user->id,
        //         'country_id'    => $user->country_id
        //     ]);
    
        //     $address = factory(Address::class)->create([
        //         'user_id'       => $user->id,
        //         'country_id'    => $user->country_id
        //     ]);
        // }
        $user = factory(User::class)->create([
            'name'                  => 'Miguel',
            'lastname'              => 'Acosta',
            'email'                 => 'miguel.acosta1978@gmail.com',
            'password'              => bcrypt('123456'),
            'email_verified_at'     => now(),
            'account_verified_at'   => now(),
        ]);

        // $user->assignRole('user');

        // $identity = factory(Identity::class)->create([
        //     'user_id'   => $user->id,
        //     'verified_at'   => now(),
        // ]);

        // $address = factory(Address::class)->create([
        //     'user_id'   => $user->id,
        //     'verified_at'   => now(),
        // ]);

    }
}
