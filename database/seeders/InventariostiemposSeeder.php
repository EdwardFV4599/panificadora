<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InventariostiemposImport;

class InventariostiemposSeeder extends Seeder
{
/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = public_path('inventariostiempos.xlsx');  // Ruta completa del archivo en la carpeta public
        Excel::import(new InventariostiemposImport, $filePath);  // Importa el archivo desde la ruta
    }
}
