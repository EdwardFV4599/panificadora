<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ComprastiemposImport;

class ComprastiemposSeeder extends Seeder
{
/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = public_path('comprastiempos.xlsx');  // Ruta completa del archivo en la carpeta public
        Excel::import(new ComprastiemposImport, $filePath);  // Importa el archivo desde la ruta
    }
}
