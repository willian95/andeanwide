<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $role = Role::create(['name' => 'admin']);
        //$role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'agent']);
        $role = Role::create(['name' => 'user']);

        //le agregamos user-admin a todos los users seedeados
        $users = App\User::all();

        foreach ($users as $user) {
            $user->assignRole('admin');
        }
    }
}
