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
        $dataVentas = [
            'ventasPorMes' => $ventasPorMes,
            'tipoGrafico' => $tipoGrafico,
        ];

        $dataCantidad = [
            'cantidadPorMes' => $cantidadPorMes,
            'tipoGrafico' => $tipoGrafico,
        ];

        // Generar el HTML para los gráficos
        $htmlVentas = view('reportes.grafico_ventas', $dataVentas)->render();
        $htmlCantidad = view('reportes.grafico_cantidad', $dataCantidad)->render();

        // Guardar las gráficas como imágenes
        $graficoVentasPath = storage_path('app/public/grafico_ventas.png');
        $graficoCantidadPath = storage_path('app/public/grafico_cantidad.png');
        
        Browsershot::html($htmlVentas)->windowSize(1200, 800)->save($graficoVentasPath);
        Browsershot::html($htmlCantidad)->windowSize(1200, 800)->save($graficoCantidadPath);

        // Datos para el PDF
        $pdfData = [
            'productoNombre' => $productoNombre,
            'fechaInicio' => $fechaInicio,
            'fechaFinal' => $fechaFinal,
            'ventasPorMes' => $ventasPorMes,
            'cantidadPorMes' => $cantidadPorMes,
            'graficoVentasPath' => $graficoVentasPath,
            'graficoCantidadPath' => $graficoCantidadPath,
        ];

        // Crear el PDF con los datos y los gráficos
        $pdf = PDF::loadView('reportes.reporte_tactico', $pdfData);

        return $pdf->download("reporte_tactico_{$productoNombre}.pdf");
    }
}
