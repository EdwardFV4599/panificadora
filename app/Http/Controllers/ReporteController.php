<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentasProductoDetalle;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;

class ReporteController extends Controller
{
    public function generarReporte(Request $request)
    {
        // Recibir los parámetros del formulario
        $productoId = $request->input('producto_id');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFinal = $request->input('fecha_final');
        $tipoGrafico = $request->input('tipo_grafico');

        // Realizar la consulta de ventas según los parámetros
        $ventasQuery = VentasProductoDetalle::selectRaw(
            'producto_id, MONTH(vp.fecha) as mes, SUM(cantidad) as total_cantidad, SUM(cantidad * precio) as total_precio'
        )
            ->join('ventasproductos as vp', 'ventasproductodetalles.ventasproducto_id', '=', 'vp.id')
            ->whereYear('vp.fecha', 2024);

        if ($productoId) {
            $ventasQuery->where('producto_id', $productoId);
        }
        
        if ($fechaInicio) {
            $ventasQuery->where('vp.fecha', '>=', $fechaInicio);
        }

        if ($fechaFinal) {
            $ventasQuery->where('vp.fecha', '<=', $fechaFinal);
        }

        $ventas = $ventasQuery->groupBy('producto_id', 'mes')->get();

        // Organizar los datos
        $ventasPorMes = [];
        $cantidadPorMes = [];
        $totalGeneral = 0;

        foreach ($ventas as $venta) {
            $ventasPorMes[$venta->mes] = ($ventasPorMes[$venta->mes] ?? 0) + $venta->total_precio;
            $cantidadPorMes[$venta->mes] = ($cantidadPorMes[$venta->mes] ?? 0) + $venta->total_cantidad;
            $totalGeneral += $venta->total_precio;
        }

        // Obtener nombre del producto si es necesario
        $productoNombre = $productoId ? Producto::find($productoId)->nombre ?? 'Producto no encontrado' : 'Todos los productos';

        // Datos para la gráfica
        $data = [
            'ventasPorMes' => $ventasPorMes,
            'cantidadPorMes' => $cantidadPorMes,
            'tipoGrafico' => $tipoGrafico,
        ];

        // Generar el HTML para el gráfico
        $html = view('reportes.grafico', $data)->render();

        // Guardar la gráfica como imagen
        $graficoPath = storage_path('app/public/grafico_ventas.png');
        Browsershot::html($html)->windowSize(800, 600)->save($graficoPath);

        // Datos para el PDF
        $pdfData = [
            'productoNombre' => $productoNombre,
            'fechaInicio' => $fechaInicio,
            'fechaFinal' => $fechaFinal,
            'ventasPorMes' => $ventasPorMes,
            'cantidadPorMes' => $cantidadPorMes,
            'graficoPath' => $graficoPath,
        ];

        // Crear el PDF con los datos y el gráfico
        $pdf = PDF::loadView('reportes.reporte_tactico', $pdfData);

        return $pdf->download("reporte_tactico_{$productoNombre}.pdf");
    }
}
