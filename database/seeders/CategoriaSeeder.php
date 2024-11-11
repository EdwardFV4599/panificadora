<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Panadería',
            'estado' => 1,
        ]);

        Categoria::create([
            'nombre' => 'Repostería',
            'estado' => 1,
        ]);

        Categoria::create([
            'nombre' => 'Galletas',
            'estado' => 1,
        ]);

        Categoria::create([
            'nombre' => 'Pastelería',
            'estado' => 1,
        ]);
    }
}
