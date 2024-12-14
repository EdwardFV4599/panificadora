<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Llama a otros seeders aquí
        $this->call([
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
            InsumoSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            ProveedorSeeder::class,
            ComprasInsumosSeeder::class,
            VentasproductoSeeder::class,
            VentastiemposSeeder::class,
            InventariostiemposSeeder::class,
            ReportestiemposSeeder::class,

            // Agrega aquí más seeders que quieras ejecutar
        ]);
    }
}
