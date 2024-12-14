<?php

namespace App\Imports;

use App\Models\Inventariostiempos;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventariostiemposImport implements ToCollection, WithHeadingRow
{
    /**
     * Transform the row into a model.
     *
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Verificar si 'codigo_compra' tiene un valor
            if (empty($row['codigo_compra'])) {
                continue; // Salta esta fila si no tiene valor 'codigo_compra'
            }

            // Convertir la fecha de Excel (número de días desde 1900-01-01) a formato 'Y-m-d'
            $fecha = $this->convertExcelDateToDate($row['fecha']);

            // Convertir las horas de fracción de día a formato 'H:i:s'
            $hora_inicial = $this->convertFractionToTime($row['hora_inicial']);
            $hora_final = $this->convertFractionToTime($row['hora_final']);

            // Crear el registro en la base de datos
            Inventariostiempos::create([
                'codigo_compra' => $row['codigo_compra'],
                'fecha' => $fecha,  // Fecha convertida a 'Y-m-d'
                'hora_inicial' => $hora_inicial,
                'hora_final' => $hora_final,
                'duracion' => $row['duracion'],
                'error' => $row['error'],
            ]);
        }
    }

    /**
     * Convertir la fecha de Excel (número de días desde 1900-01-01) a formato 'Y-m-d'
     *
     * @param float $excelDate
     * @return string
     */
    private function convertExcelDateToDate($excelDate)
    {
        // Convertir la fecha de Excel a un objeto Carbon
        return Carbon::createFromFormat('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate)->format('Y-m-d'));
    }

    /**
     * Convertir una fracción de día a formato 'H:i:s'
     *
     * @param float $fraction
     * @return string
     */
    private function convertFractionToTime($fraction)
    {
        $hours = floor($fraction * 24);
        $minutes = floor(($fraction * 24 * 60) % 60);
        $seconds = floor(($fraction * 24 * 60 * 60) % 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
