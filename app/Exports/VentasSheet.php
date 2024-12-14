<?php

namespace App\Exports;

use App\Models\Ventastiempos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class VentasSheet implements FromCollection, WithTitle
{
    /**
     * Devuelve la colección de datos de Ventastiempos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ventastiempos::all();
    }

    /**
     * Define el nombre de la hoja.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Ventas'; // Nombre personalizado de la hoja
    }
}
