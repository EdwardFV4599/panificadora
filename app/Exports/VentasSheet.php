<?php

namespace App\Exports;

use App\Models\Ventastiempos;
use Maatwebsite\Excel\Concerns\FromCollection;

class VentasSheet implements FromCollection
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
}
