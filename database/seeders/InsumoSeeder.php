<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Insumo;

class InsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear insumos para los productos
        Insumo::create([
            'nombre' => 'Harina de Trigo',
            'unidad' => 'kg',
            'stock_actual' => 100,
            'descripcion' => 'Harina de trigo para panadería y repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Azúcar',
            'unidad' => 'kg',
            'stock_actual' => 100,
            'descripcion' => 'Azúcar blanca granulada',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Chocolate',
            'unidad' => 'kg',
            'stock_actual' => 50,
            'descripcion' => 'Chocolate para repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Leche',
            'unidad' => 'litro',
            'stock_actual' => 100,
            'descripcion' => 'Leche fresca',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Mantequilla',
            'unidad' => 'kg',
            'stock_actual' => 50,
            'descripcion' => 'Mantequilla para panadería y repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Huevos',
            'unidad' => 'unidad',
            'stock_actual' => 120,
            'descripcion' => 'Huevos frescos',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Avena',
            'unidad' => 'kg',
            'stock_actual' => 120,
            'descripcion' => 'Avena para galletas y repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Fresas',
            'unidad' => 'kg',
            'stock_actual' => 20,
            'descripcion' => 'Fresas frescas',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Manzanas',
            'unidad' => 'kg',
            'stock_actual' => 20,
            'descripcion' => 'Manzanas frescas',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Crema de leche',
            'unidad' => 'litro',
            'stock_actual' => 20,
            'descripcion' => 'Crema de leche para repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Sal',
            'unidad' => 'kg',
            'stock_actual' => 50,
            'descripcion' => 'Sal para panadería y repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Levadura',
            'unidad' => 'kg',
            'stock_actual' => 50,
            'descripcion' => 'Levadura para panadería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Canela',
            'unidad' => 'kg',
            'stock_actual' => 20,
            'descripcion' => 'Canela en polvo para repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Leche condensada',
            'unidad' => 'litro',
            'stock_actual' => 50,
            'descripcion' => 'Leche condensada para repostería',
            'estado' => 1,
        ]);

        Insumo::create([
            'nombre' => 'Agua',
            'unidad' => 'litro',
            'stock_actual' => 500,
            'descripcion' => 'Agua para preparación de panadería y repostería',
            'estado' => 1,
        ]);
    }
}
