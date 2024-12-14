<?php

namespace App\Exports;

use App\Models\Inventariostiempos;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventariosSheet implements FromCollection
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
}
