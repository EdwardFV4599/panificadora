<?php

namespace App\Exports;

use App\Models\Reportestiempos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReportesSheet implements FromCollection, WithTitle
{
    /**
     * Devuelve la colección de datos de Reportestiempos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Reportestiempos::all();
    }

    /**
     * Define el nombre de la hoja.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Reportes'; // Nombre personalizado de la hoja
    }
}
