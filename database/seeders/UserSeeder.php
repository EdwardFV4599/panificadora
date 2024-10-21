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
            'name' => 'Edward Faichin Vasquez',
            'email' => 'administrador@example.com',
            'password' => bcrypt('administrador4599'),
        ]);
        // Asignar rol
        $user->assignRole('administrador');
        // ------------------------------------------------------------------------------

        // Crear un usuario
        $user = User::create([
            'name' => 'Daarick Lujan Abril',
            'email' => 'almacenista@example.com',
            'password' => bcrypt('almacenista4599'),
        ]);
        // Asignar rol
        $user->assignRole('almacenista');
        // ------------------------------------------------------------------------------
        
        // Crear un usuario
        $user = User::create([
            'name' => 'Walber Coronel',
            'email' => 'gerente@example.com',
            'password' => bcrypt('gerente4599'),
        ]);
        // Asignar rol
        $user->assignRole('gerente');
        // ------------------------------------------------------------------------------

        // Crear un usuario
        $user = User::create([
            'name' => 'Mario Marin Moncada',
            'email' => 'vendedor@example.com',
            'password' => bcrypt('vendedor4599'),
        ]);
        // Asignar rol
        $user->assignRole('vendedor');
        // ------------------------------------------------------------------------------

        // Crear un usuario sin rol ni permisos
        $user = User::create([
            'name' => 'Diego Aquino',
            'email' => 'prueba@example.com',
            'password' => bcrypt('prueba4599159'),
        ]);
        // Asignar rol
        // $user->assignRole('administrador');
        // Asignar permisos
        // $user->givePermissionTo(['ver-home','gestionar-usuarios']);
        // ------------------------------------------------------------------------------
    }
}
