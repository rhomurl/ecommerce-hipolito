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
            'name' => 'User Test',
            'email' => 'user@ex.com',
            'password' => Hash::make('admin123456'),
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@ex.com',
            'password' => Hash::make('admin123456'),
        ]);
        $user->assignRole($role2);

    }
}
