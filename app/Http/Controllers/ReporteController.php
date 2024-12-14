<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventasproductodetalle;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        // Iniciar temporizador al acceder a la vista
        session(['reporte_inicio' => now()]); // Guardamos el tiempo actual en la sesión
        $productos = Producto::where('estado', 1)->get();
        return view('reportes.index', compact('productos'));
    }

    public function generarReporte(Request $request)
    {
        // Recibir los parámetros del formulario
        $productoId = $request->input('producto_id');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFinal = $request->input('fecha_final');
        $tipoGrafico = $request->input('tipo_grafico');

        // Realizar la consulta de ventas según los parámetros
        $ventasQuery = Ventasproductodetalle::selectRaw(
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

        // Convertir los números de mes (1-12) a nombres de meses en español
        $nombresMeses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        // Convertir las claves (números de mes) a nombres de meses
        $labelsVentas = array_map(function($mes) use ($nombresMeses) {
            return $nombresMeses[$mes];
        }, array_keys($ventasPorMes));

        $labelsCantidad = array_map(function($mes) use ($nombresMeses) {
            return $nombresMeses[$mes];
        }, array_keys($cantidadPorMes));

        // Obtener nombre del producto si es necesario
        $productoNombre = $productoId ? Producto::find($productoId)->nombre ?? 'Producto no encontrado' : 'Todos los productos';

        // Datos para la gráfica
        $dataVentas = [
            'ventasPorMes' => $ventasPorMes,
            'labelsVentas' => $labelsVentas,
            'tipoGrafico' => $tipoGrafico,
        ];

        $dataCantidad = [
            'cantidadPorMes' => $cantidadPorMes,
            'labelsCantidad' => $labelsCantidad,
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

        // --------------------------------- TIMER --------------------------------------------
        // Recuperar el tiempo de inicio desde la sesión
        $tiempo_inicial = session('reporte_inicio');
        $tiempo_final = now();

        // Calcular la duración en segundos
        $duracion = $tiempo_inicial->diffInSeconds($tiempo_final);

        // Crear la fecha del dia actual
        $fecha_actual = now()->toDateString();

        // Convertir los tiempos creado con now() a formato solo hora
        $hora_inicial = $tiempo_inicial->format('H:i:s');
        $hora_final = $tiempo_final->format('H:i:s');

        // Registrar en la base de datos
        \DB::table('reportestiempos')->insert([
            'fecha' => $fecha_actual,
            'hora_inicial' => $hora_inicial,
            'hora_final' => $hora_final,
            'duracion' => $duracion
        ]);
        // ------------------------------------------------------------------------------------

        // Crear el PDF con los datos y los gráficos
        $pdf = PDF::loadView('reportes.reporte_tactico', $pdfData);
        return $pdf->download("reporte_tactico_{$productoNombre}.pdf");
    }
}
