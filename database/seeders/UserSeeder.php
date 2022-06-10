<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['name' => 'customer']);
        $role2 = Role::create(['name' => 'admin']);
        $role3 = Role::create(['name' => 'super-admin']);


        $user = User::create([
            'name' => 'Don Juan',
            'email' => 'ecomhipolito+user@gmail.com',
            'password' => Hash::make('G.sMb0xK##oQ'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Ecom Admin',
            'email' => 'ecomhipolito+admin@gmail.com',
            'password' => Hash::make('AdRqHMjf`Pw^'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($role2);

        $user = User::create([
            'name' => 'Ecom Superadmin',
            'email' => 'ecomhipolito+sadmin@gmail.com',
            'password' => Hash::make('$ps,@Uv|`Fcp'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($role3);

    }
}
