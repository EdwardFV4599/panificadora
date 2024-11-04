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
        $bolleria = Categoria::where('nombre', 'Bollería')->first()->id;
        $galletas = Categoria::where('nombre', 'Galletas')->first()->id;
        $pasteleria = Categoria::where('nombre', 'Pastelería')->first()->id;

        // Crear productos para la categoría Panadería
        Producto::create([
            'nombre' => 'Pan Francés',
            'existencia_actual' => 150,
            'categoria' => $panaderia,
            'precio' => 0.50,
            'descripcion' => 'Pan crujiente ideal para el desayuno.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pan Integral',
            'existencia_actual' => 100,
            'categoria' => $panaderia,
            'precio' => 0.80,
            'descripcion' => 'Pan saludable hecho con harina integral.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Baguette',
            'existencia_actual' => 60,
            'categoria' => $panaderia,
            'precio' => 1.20,
            'descripcion' => 'Pan largo y delgado de estilo francés.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Repostería
        Producto::create([
            'nombre' => 'Tarta de Manzana',
            'existencia_actual' => 25,
            'categoria' => $reposteria,
            'precio' => 12.50,
            'descripcion' => 'Tarta dulce con manzanas frescas.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Brownie de Chocolate',
            'existencia_actual' => 50,
            'categoria' => $reposteria,
            'precio' => 1.50,
            'descripcion' => 'Brownie esponjoso con chocolate amargo.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Tarta de Fresa',
            'existencia_actual' => 20,
            'categoria' => $reposteria,
            'precio' => 14.00,
            'descripcion' => 'Tarta fresca con fresas naturales.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Bollería
        Producto::create([
            'nombre' => 'Croissant',
            'existencia_actual' => 100,
            'categoria' => $bolleria,
            'precio' => 1.20,
            'descripcion' => 'Croissant de mantequilla.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pan de Chocolate',
            'existencia_actual' => 80,
            'categoria' => $bolleria,
            'precio' => 1.50,
            'descripcion' => 'Pan relleno con chocolate fundido.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Ensaimada',
            'existencia_actual' => 40,
            'categoria' => $bolleria,
            'precio' => 2.00,
            'descripcion' => 'Dulce típico en forma de espiral.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Galletas
        Producto::create([
            'nombre' => 'Galletas de Chocolate',
            'existencia_actual' => 200,
            'categoria' => $galletas,
            'precio' => 0.75,
            'descripcion' => 'Galletas crujientes con chispas de chocolate.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Galletas de Avena',
            'existencia_actual' => 150,
            'categoria' => $galletas,
            'precio' => 0.80,
            'descripcion' => 'Galletas saludables hechas con avena.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Galletas de Jengibre',
            'existencia_actual' => 100,
            'categoria' => $galletas,
            'precio' => 0.90,
            'descripcion' => 'Galletas navideñas de jengibre.',
            'estado' => 1,
        ]);

        // Crear productos para la categoría Pastelería
        Producto::create([
            'nombre' => 'Pastel de Tres Leches',
            'existencia_actual' => 10,
            'categoria' => $pasteleria,
            'precio' => 25.00,
            'descripcion' => 'Pastel empapado en tres tipos de leche.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pastel de Chocolate',
            'existencia_actual' => 15,
            'categoria' => $pasteleria,
            'precio' => 30.00,
            'descripcion' => 'Pastel de chocolate con cobertura de crema.',
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Cheesecake',
            'existencia_actual' => 12,
            'categoria' => $pasteleria,
            'precio' => 22.00,
            'descripcion' => 'Pastel de queso con base de galleta.',
            'estado' => 1,
        ]);
    }
}
