<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VentasproductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generar 200 ventas
        for ($i = 0; $i < 500; $i++) {
            $fecha = fake()->dateTimeBetween('2024-01-01', '2024-11-30');
            $total = fake()->randomFloat(2, 50, 500); // Total entre 50 y 500
            $cliente = fake()->name();
            $estado = 1; // 0: inactivo, 1: activo

            // Insertar la venta
            $ventaId = DB::table('ventasproductos')->insertGetId([
                'fecha' => $fecha,
                'total' => $total,
                'cliente' => $cliente,
                'estado' => $estado,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Generar detalles para cada venta (entre 1 y 5 productos por venta)
            $productosPorVenta = fake()->numberBetween(1, 5);
            for ($j = 0; $j < $productosPorVenta; $j++) {
                $productoId = fake()->numberBetween(1, 9); // Asume 9 productos registrados
                $cantidad = fake()->numberBetween(1, 10);   // Cantidad entre 1 y 10
                $precio = fake()->randomFloat(2, 10, 100); // Precio unitario entre 10 y 100
                $estado = 1;

                DB::table('ventasproductodetalles')->insert([
                    'ventasproducto_id' => $ventaId,
                    'producto_id' => $productoId,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'estado' => $estado,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
