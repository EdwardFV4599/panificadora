<?php

namespace App\Exports;

use App\Models\Reportestiempos;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportesSheet implements FromCollection
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
}
