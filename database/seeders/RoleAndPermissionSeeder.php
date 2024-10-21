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
            'mantener-categorias',
            'mantener-materias-primas',
            'mantener-productos',
            'mantener-proveedores',
            'controlar-entradas-materias-primas',
            'controlar-elaboracion-productos',
            'controlar-salidas-productos',
            'controlar-cierre-de-caja',
            'generar-reportes',
            'generar-graficos',
            'generar-facturas'
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
        $gerenteRole->givePermissionTo(
            'ver-home',
            'mantener-categorias',
            'mantener-materias-primas',
            'mantener-productos',
            'mantener-proveedores',
            'controlar-entradas-materias-primas',
            'controlar-elaboracion-productos',
            'controlar-salidas-productos',
            'controlar-cierre-de-caja',
            'generar-reportes',
            'generar-graficos',
            'generar-facturas'
        );
        $almacenistaRole->givePermissionTo(
            'ver-home',
            'mantener-categorias',
            'mantener-materias-primas',
            'mantener-productos',
            'mantener-proveedores',
            'controlar-entradas-materias-primas',
            'controlar-elaboracion-productos',
        );
        $vendedorRole->givePermissionTo(
            'ver-home',
            'controlar-salidas-productos',
            'controlar-cierre-de-caja'
        );
    }
}
