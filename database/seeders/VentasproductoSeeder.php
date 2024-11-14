<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentasproductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generar 200 ventas
        for ($i = 0; $i < 200; $i++) {
            // Generar una fecha aleatoria entre Enero y Diciembre de 2024
            $fecha = Carbon::create(2024, rand(1, 12), rand(1, 28));

            // Crear una venta con un total aleatorio y un cliente aleatorio
            DB::table('ventasproductos')->insert([
                'fecha' => $fecha,
                'total' => rand(1000, 5000) / 100, // Total aleatorio entre 10 y 50
                'cliente' => 'Cliente ' . rand(1, 100), // Cliente aleatorio
                'descripcion' => 'Descripción de la venta ' . rand(1, 10), // Descripción aleatoria
                'estado' => 1, // Estado 1 (activo)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
