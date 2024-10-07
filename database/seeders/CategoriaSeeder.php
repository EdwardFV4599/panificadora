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
            'eliminado' => '0',
        ]);

        Categoria::create([
            'nombre' => 'Repostería',
            'eliminado' => '0',
        ]);

        Categoria::create([
            'nombre' => 'Bollería',
            'eliminado' => '0',
        ]);

        Categoria::create([
            'nombre' => 'Galletas',
            'eliminado' => '0',
        ]);

        Categoria::create([
            'nombre' => 'Pastelería',
            'eliminado' => '0',
        ]);
    }
}
