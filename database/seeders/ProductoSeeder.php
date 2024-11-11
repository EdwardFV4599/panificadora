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
        $pasteleria = Categoria::where('nombre', 'Pastelería')->first()->id;

        // Crear productos para la categoría Panadería
        Producto::create([
            'nombre' => 'Pan Francés',
            'stock_actual' => 150,
            'categoria' => $panaderia,
            'precio' => 0.50,
            'descripcion' => 'Pan crujiente ideal para el desayuno.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pan Integral',
            'stock_actual' => 100,
            'categoria' => $panaderia,
            'precio' => 0.80,
            'descripcion' => 'Pan saludable hecho con harina integral.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Repostería
        Producto::create([
            'nombre' => 'Tarta de Manzana',
            'stock_actual' => 25,
            'categoria' => $reposteria,
            'precio' => 12.50,
            'descripcion' => 'Tarta dulce con manzanas frescas.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Brownie de Chocolate',
            'stock_actual' => 50,
            'categoria' => $reposteria,
            'precio' => 1.50,
            'descripcion' => 'Brownie esponjoso con chocolate amargo.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Tarta de Fresa',
            'stock_actual' => 20,
            'categoria' => $reposteria,
            'precio' => 14.00,
            'descripcion' => 'Tarta fresca con fresas naturales.',
            'estado' => 1,
        ]);


        // Crear productos para la categoría Galletas
        Producto::create([
            'nombre' => 'Galletas de Chocolate',
            'stock_actual' => 200,
            'categoria' => $galletas,
            'precio' => 0.75,
            'descripcion' => 'Galletas crujientes con chispas de chocolate.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Galletas de Avena',
            'stock_actual' => 150,
            'categoria' => $galletas,
            'precio' => 0.80,
            'descripcion' => 'Galletas saludables hechas con avena.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Pastelería
        Producto::create([
            'nombre' => 'Pastel de Tres Leches',
            'stock_actual' => 10,
            'categoria' => $pasteleria,
            'precio' => 25.00,
            'descripcion' => 'Pastel empapado en tres tipos de leche.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pastel de Chocolate',
            'stock_actual' => 15,
            'categoria' => $pasteleria,
            'precio' => 30.00,
            'descripcion' => 'Pastel de chocolate con cobertura de crema.',
            'estado' => 1,
        ]);
    }
}
