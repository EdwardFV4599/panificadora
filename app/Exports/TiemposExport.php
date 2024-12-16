<?php

namespace App\Exports;

use App\Models\Ventastiempos;
use App\Models\Comprastiempos;
use App\Models\Reportestiempos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TiemposExport implements WithMultipleSheets, ShouldAutoSize
{
    /**
     * Devuelve las hojas para la exportación con nombres personalizados.
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            new VentasSheet(),
            new ComprasSheet(),
            new ReportesSheet(),
        ];
    }
}

