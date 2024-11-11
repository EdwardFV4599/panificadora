<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comprasinsumo;
use App\Models\Insumo;
use App\Models\Proveedor;
use Carbon\Carbon;

class ComprasInsumosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $encargado = 'Daarick Lujan Abril';
        $insumos = Insumo::all();
        $proveedores = Proveedor::all();

        foreach ($insumos as $insumo) {
            // Crear 10 compras para cada insumo
            for ($i = 0; $i < 10; $i++) {
                Comprasinsumo::create([
                    'insumo' => $insumo->id,
                    'proveedor' => $proveedores->random()->id,
                    'stock_agregado' => rand(20, 100),  // Varía entre 20 y 100 para agregar diversidad
                    'precio' => rand(5, 50),            // Precio aleatorio entre 5 y 50
                    'encargado' => $encargado,
                    'fecha' => Carbon::now()->subMonths(rand(0, 3))->subDays(rand(0, 30)),
                    'descripcion' => 'Compra de ' . $insumo->nombre,
                    'estado' => 1,
                ]);
            }
        }
    }
}
