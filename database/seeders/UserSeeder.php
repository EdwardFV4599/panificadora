<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario
        $user = User::create([
            'name' => 'Admin General',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin4599159'),
        ]);
        // Asignar rol
        $user->assignRole('admin');
        // Asignar permisos
        $user->givePermissionTo(['manage-users', 'view-dashboard']);
        // ------------------------------------------------------------------------------

        // Crear un usuario
        $user = User::create([
            'name' => 'Moises',
            'email' => 'moises@example.com',
            'password' => bcrypt('password123'),
        ]);
        // Asignar rol
        $user->assignRole('user');
        // Asignar permisos
        $user->givePermissionTo(['view-dashboard']);
        // ------------------------------------------------------------------------------
        
        // Crear un usuario
        $user = User::create([
            'name' => 'Edward',
            'email' => 'edward@example.com',
            'password' => bcrypt('edward4599159'),
        ]);
        // Asignar rol
        $user->assignRole('user');
        // Asignar permisos
        $user->givePermissionTo(['view-dashboard']);
        // ------------------------------------------------------------------------------

        // Crear un usuario sin rol ni permisos
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@example.com',
            'password' => bcrypt('prueba4599159'),
        ]);
        // ------------------------------------------------------------------------------
    }
}
