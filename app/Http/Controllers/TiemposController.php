<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ventastiempos;
use App\Models\Comprastiempos;
use App\Models\Reportestiempos;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TiemposExport;

class TiemposController extends Controller
{
    // Método para mostrar la vista con los datos
    public function index()
    {
        $ventastiempos = Ventastiempos::all();
        $comprastiempos = Comprastiempos::all();
        $reportestiempos = Reportestiempos::all();

        return view('tiempos.index', compact('ventastiempos', 'comprastiempos', 'reportestiempos'));
    }

    // Método para exportar los datos en formato Excel
    public function exportExcel()
    {
        return Excel::download(new TiemposExport, 'tiempos.xlsx');
    }

    // Método para exportar los datos en formato PDF
    public function exportPdf()
    {
        $ventastiempos = Ventastiempos::all();
        $comprastiempos = Comprastiempos::all();
        $reportestiempos = Reportestiempos::all();

        $pdf = Pdf::loadView('tiempos.pdf', compact('ventastiempos', 'comprastiempos', 'reportestiempos'));
        
        return $pdf->download('tiempos.pdf');
    }
}
