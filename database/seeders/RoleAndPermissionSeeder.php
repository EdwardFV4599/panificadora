<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'gestionar-usuarios',
            'gestionar-roles-permisos',
            'ver-home',
            'gestionar-materias-primas',
            'gestionar-productos',
            'gestionar-proveedores',
            'gestionar-compras',
            'gestionar-ventas',
            'controlar-stock',
            'controlar-cierre-de-caja',
            'generar-reportes',
            'generar-gráficos',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles
        $administradorRole = Role::create(['name' => 'administrador']);
        $gerenteRole = Role::create(['name' => 'gerente']);
        $almacenistaRole = Role::create(['name' => 'almacenista']);
        $vendedorRole = Role::create(['name' => 'vendedor']);

        // Asignar permisos a roles
        $administradorRole->givePermissionTo($permissions); // Asignar todos los permisos al admin

        $gerenteRole->givePermissionTo('ver-home','gestionar-proveedores'); // Asignar 'ver-home' y 'gestionar-proveedores'
        $almacenistaRole->givePermissionTo('ver-home','gestionar-materias-primas','gestionar-productos');
        $vendedorRole->givePermissionTo('ver-home','gestionar-ventas');
    }
}
