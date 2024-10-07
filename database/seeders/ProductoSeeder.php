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
            'cantidad' => 150,
            'categoria' => $panaderia,
            'precio' => 0.50,
            'descripcion' => 'Pan crujiente ideal para el desayuno.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Pan Integral',
            'cantidad' => 100,
            'categoria' => $panaderia,
            'precio' => 0.80,
            'descripcion' => 'Pan saludable hecho con harina integral.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Baguette',
            'cantidad' => 60,
            'categoria' => $panaderia,
            'precio' => 1.20,
            'descripcion' => 'Pan largo y delgado de estilo francés.',
            'eliminado' => '0',
        ]);

        // Crear productos para la categoría Repostería
        Producto::create([
            'nombre' => 'Tarta de Manzana',
            'cantidad' => 25,
            'categoria' => $reposteria,
            'precio' => 12.50,
            'descripcion' => 'Tarta dulce con manzanas frescas.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Brownie de Chocolate',
            'cantidad' => 50,
            'categoria' => $reposteria,
            'precio' => 1.50,
            'descripcion' => 'Brownie esponjoso con chocolate amargo.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Tarta de Fresa',
            'cantidad' => 20,
            'categoria' => $reposteria,
            'precio' => 14.00,
            'descripcion' => 'Tarta fresca con fresas naturales.',
            'eliminado' => '0',
        ]);

        // Crear productos para la categoría Bollería
        Producto::create([
            'nombre' => 'Croissant',
            'cantidad' => 100,
            'categoria' => $bolleria,
            'precio' => 1.20,
            'descripcion' => 'Croissant de mantequilla.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Pan de Chocolate',
            'cantidad' => 80,
            'categoria' => $bolleria,
            'precio' => 1.50,
            'descripcion' => 'Pan relleno con chocolate fundido.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Ensaimada',
            'cantidad' => 40,
            'categoria' => $bolleria,
            'precio' => 2.00,
            'descripcion' => 'Dulce típico en forma de espiral.',
            'eliminado' => '0',
        ]);

        // Crear productos para la categoría Galletas
        Producto::create([
            'nombre' => 'Galletas de Chocolate',
            'cantidad' => 200,
            'categoria' => $galletas,
            'precio' => 0.75,
            'descripcion' => 'Galletas crujientes con chispas de chocolate.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Galletas de Avena',
            'cantidad' => 150,
            'categoria' => $galletas,
            'precio' => 0.80,
            'descripcion' => 'Galletas saludables hechas con avena.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Galletas de Jengibre',
            'cantidad' => 100,
            'categoria' => $galletas,
            'precio' => 0.90,
            'descripcion' => 'Galletas navideñas de jengibre.',
            'eliminado' => '0',
        ]);

        // Crear productos para la categoría Pastelería
        Producto::create([
            'nombre' => 'Pastel de Tres Leches',
            'cantidad' => 10,
            'categoria' => $pasteleria,
            'precio' => 25.00,
            'descripcion' => 'Pastel empapado en tres tipos de leche.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Pastel de Chocolate',
            'cantidad' => 15,
            'categoria' => $pasteleria,
            'precio' => 30.00,
            'descripcion' => 'Pastel de chocolate con cobertura de crema.',
            'eliminado' => '0',
        ]);

        Producto::create([
            'nombre' => 'Cheesecake',
            'cantidad' => 12,
            'categoria' => $pasteleria,
            'precio' => 22.00,
            'descripcion' => 'Pastel de queso con base de galleta.',
            'eliminado' => '0',
        ]);
    }
}
