<?php

namespace App\Exports;

use App\Models\Comprastiempos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class ComprasSheet implements FromCollection, WithTitle
{
    /**
     * Devuelve la colección de datos de Comprastiempos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Comprastiempos::all();
    }

    /**
     * Define el nombre de la hoja.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Compras'; // Nombre personalizado de la hoja
    }
}
