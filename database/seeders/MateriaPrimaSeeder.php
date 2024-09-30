<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MateriaPrima;

class MateriaPrimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MateriaPrima::create([
            'nombre' => 'Harina de Trigo',
            'cantidad' => 500,
            'unidad' => 'kg',
            'precio' => 60.00,
            'descripcion' => 'Harina refinada para la elaboración de panes',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Harina Integral',
            'cantidad' => 300,
            'unidad' => 'kg',
            'precio' => 75.00,
            'descripcion' => 'Harina integral para panes de grano entero',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Azúcar',
            'cantidad' => 200,
            'unidad' => 'kg',
            'precio' => 45.00,
            'descripcion' => 'Azúcar blanca granulada',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Sal',
            'cantidad' => 100,
            'unidad' => 'kg',
            'precio' => 12.00,
            'descripcion' => 'Sal refinada para la preparación de masas',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Aceite Vegetal',
            'cantidad' => 50,
            'unidad' => 'litros',
            'precio' => 80.00,
            'descripcion' => 'Aceite vegetal para preparar masa y freír',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Mantequilla',
            'cantidad' => 80,
            'unidad' => 'kg',
            'precio' => 120.00,
            'descripcion' => 'Mantequilla para la preparación de productos de repostería',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Levadura Fresca',
            'cantidad' => 40,
            'unidad' => 'kg',
            'precio' => 95.00,
            'descripcion' => 'Levadura fresca para fermentación de masas',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Leche en Polvo',
            'cantidad' => 60,
            'unidad' => 'kg',
            'precio' => 85.00,
            'descripcion' => 'Leche en polvo para enriquecer la masa',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Huevos',
            'cantidad' => 500,
            'unidad' => 'unidades',
            'precio' => 300.00,
            'descripcion' => 'Huevos frescos para la preparación de masas y repostería',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Canela',
            'cantidad' => 20,
            'unidad' => 'kg',
            'precio' => 25.00,
            'descripcion' => 'Canela molida para saborizar productos de panadería',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Chocolate en Trozos',
            'cantidad' => 30,
            'unidad' => 'kg',
            'precio' => 150.00,
            'descripcion' => 'Chocolate en trozos para panes dulces y repostería',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Pasas',
            'cantidad' => 20,
            'unidad' => 'kg',
            'precio' => 40.00,
            'descripcion' => 'Pasas para agregar en panes dulces',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Semillas de Sésamo',
            'cantidad' => 15,
            'unidad' => 'kg',
            'precio' => 30.00,
            'descripcion' => 'Semillas de sésamo para decorar panes y bollos',
            'eliminado' => '0',
        ]);

        MateriaPrima::create([
            'nombre' => 'Jarabe de Maíz',
            'cantidad' => 50,
            'unidad' => 'litros',
            'precio' => 70.00,
            'descripcion' => 'Jarabe de maíz para endulzar productos de panadería',
            'eliminado' => '0',
        ]);
    }
}