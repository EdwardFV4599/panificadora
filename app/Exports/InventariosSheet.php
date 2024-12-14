<?php

namespace App\Exports;

use App\Models\Inventariostiempos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class InventariosSheet implements FromCollection, WithTitle
{
    /**
     * Devuelve la colección de datos de Inventariostiempos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Inventariostiempos::all();
    }

    /**
     * Define el nombre de la hoja.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Inventarios'; // Nombre personalizado de la hoja
    }
}
