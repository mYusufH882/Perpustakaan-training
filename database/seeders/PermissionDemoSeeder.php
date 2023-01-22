<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $operatorRole = Role::create(['name' => 'operator']);

        $adminRole = Role::create(['name' => 'admin']);

        $user = User::factory()->create([
            'name' => 'Operator User',
            'email' => 'operator@mail.com',
            'password' => bcrypt('12345678'),
            'no_telepon' => '',
            'alamat' => '',
            'foto_profil' => 'default.jpg'
        ]);
        $user->assignRole($operatorRole);

        $user = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
            'no_telepon' => '',
            'alamat' => '',
            'foto_profil' => 'default.jpg'
        ]);
        $user->assignRole($adminRole);
    }
}
