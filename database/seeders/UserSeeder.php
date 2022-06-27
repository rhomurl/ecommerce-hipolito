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
            'name' => 'Rhomuel Brian Macahilig',
            'email' => 'rhomuelbrian.macahilig@ama.edu.ph',
            'password' => Hash::make('lPSjRmBiCjW1$'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Rosalie Cruz',
            'email' => 'rosaliecruz@pm.me',
            'password' => Hash::make('M5nfBK5DH&pfz'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Ecom Admin',
            'email' => 'ecomhipolito+admin@gmail.com',
            'password' => Hash::make('HRz5FPFpQIRw#'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($role2);

        $user = User::create([
            'name' => 'Ecom Superadmin',
            'email' => 'ecomhipolito+super@gmail.com',
            'password' => Hash::make('yMRF2&0sUYvc4T'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($role3);

    }
}
