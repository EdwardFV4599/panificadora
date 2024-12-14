<?php

namespace App\Exports;

use App\Models\Ventastiempos;
use App\Models\Inventariostiempos;
use App\Models\Reportestiempos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TiemposExport implements WithMultipleSheets, ShouldAutoSize
{
    /**
     * Devuelve las hojas para la exportación.
     *
     * @return array
     */
    public function sheets(): array
    {
        // Crear una hoja para Ventas
        $ventasSheet = new VentasSheet();

        // Crear una hoja para Inventarios
        $inventariosSheet = new InventariosSheet();

        // Crear una hoja para Reportes
        $reportesSheet = new ReportesSheet();

        return [
            'Ventas' => $ventasSheet,
            'Inventarios' => $inventariosSheet,
            'Reportes' => $reportesSheet,
        ];
    }
}

