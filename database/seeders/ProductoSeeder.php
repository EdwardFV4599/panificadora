<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $panaderia = Categoria::where('nombre', 'Panadería')->first()->id;
        $reposteria = Categoria::where('nombre', 'Repostería')->first()->id;
        $galletas = Categoria::where('nombre', 'Galletas')->first()->id;

        // Crear productos para la categoría Panadería
        Producto::create([
            'nombre' => 'Pan francés',
            'stock_actual' => 100,
            'categoria' => $panaderia,
            'precio' => 0.25,
            'descripcion' => 'Pan crujiente ideal para el desayuno.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pan de yema',
            'stock_actual' => 120,
            'categoria' => $panaderia,
            'precio' => 0.25,
            'descripcion' => 'Pan de yema ideal para el desayuno y la cena.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pan integral',
            'stock_actual' => 100,
            'categoria' => $panaderia,
            'precio' => 0.25,
            'descripcion' => 'Pan saludable hecho con harina integral.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Repostería
        Producto::create([
            'nombre' => 'Torta de manzana',
            'stock_actual' => 25,
            'categoria' => $reposteria,
            'precio' => 40.00,
            'descripcion' => 'Torta dulce con manzanas frescas.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Torta de fresa',
            'stock_actual' => 20,
            'categoria' => $reposteria,
            'precio' => 40.00,
            'descripcion' => 'Torta fresca con fresas naturales.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Torta de tres leches',
            'stock_actual' => 12,
            'categoria' => $reposteria,
            'precio' => 45.00,
            'descripcion' => 'Torta empapado en tres tipos de leche.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Torta de chocolate',
            'stock_actual' => 15,
            'categoria' => $reposteria,
            'precio' => 45.00,
            'descripcion' => 'Torta de chocolate con cobertura de crema.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Galletas
        Producto::create([
            'nombre' => 'Galletas de chocolate',
            'stock_actual' => 100,
            'categoria' => $galletas,
            'precio' => 0.50,
            'descripcion' => 'Galletas crujientes con chispas de chocolate.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Galletas de avena',
            'stock_actual' => 120,
            'categoria' => $galletas,
            'precio' => 0.50,
            'descripcion' => 'Galletas saludables hechas con avena.',
            'estado' => 1,
        ]);
    }
}
