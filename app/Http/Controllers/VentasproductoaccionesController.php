<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventasproducto;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class VentasproductoaccionesController extends Controller
{

    // Exportar ventas -------------------------------------------------------------------
    public function exportarVentasCsv()
    {
        // Obtener los datos de ventas, incluyendo los detalles y los productos relacionados
        $ventas = Ventasproducto::with('detalles.producto')->get();
    
        // Crear un archivo CSV
        $csvFileName = 'ventas.csv';
        $file = fopen(storage_path($csvFileName), 'w');
    
        // Escribir la cabecera del CSV
        fputcsv($file, ['producto_id', 'producto_nombre', 'cantidad_vendida', 'año', 'mes', 'día']);
    
        // Escribir los datos de ventas
        foreach ($ventas as $venta) {
            foreach ($venta->detalles as $detalle) {
                // Dividir la fecha en año, mes y día
                $fecha = $venta->created_at; // Obtener la fecha de la venta
                $año = $fecha->year; // Año
                $mes = $fecha->month; // Mes
                $dia = $fecha->day; // Día
    
                // Escribir los datos de cada venta en el CSV
                fputcsv($file, [
                    'producto_id' => $detalle->producto_id,
                    'producto_nombre' => $detalle->producto->nombre, // Nombre del producto (suponiendo que 'nombre' es la propiedad)
                    'cantidad_vendida' => $detalle->cantidad,
                    'año' => $año,
                    'mes' => $mes,
                    'día' => $dia
                ]);
            }
        }
    
        fclose($file);
    
        // Descargar el archivo CSV y eliminarlo después de enviarlo
        return response()->download(storage_path($csvFileName))->deleteFileAfterSend(true);
    }
    

    // Método para obtener las ventas desde la base de datos -------------------------------------------
    public function obtenerDatosVentas(Request $request)
    {
        // Obtener las ventas con los detalles y productos relacionados
        $ventas = Ventasproducto::with('detalles.producto')->get();
    
        // Preparar los datos para ser enviados a la API
        $resultados = [];
    
        foreach ($ventas as $venta) {
            foreach ($venta->detalles as $detalle) {
                $resultados[] = [
                    'producto_nombre' => $detalle->producto->nombre,  // Nombre del producto
                    'cantidad_vendida' => $detalle->cantidad,
                    'año' => $venta->created_at->year,   // Año de la venta
                    'mes' => $venta->created_at->month,  // Mes de la venta
                    'dia' => $venta->created_at->day,    // Día de la venta
                    'producto_id' => $detalle->producto_id, // ID del producto
                ];
            }
        }
    
        // Retornar los resultados en formato JSON
        return response()->json($resultados);
    }


    // Generar reporte pdf -----------------------------------------------------------------
    public function generarReportePdf()
    {
        // Datos de prueba (en lugar de obtener datos de la base de datos)
        $ventas = collect(Ventasproducto::with('detalles.producto')->where('estado', 1)->get());


        // Generar el PDF con la vista 'ventasproductos.reporte'
        $pdf = Pdf::loadView('ventasproductos.reporte', compact('ventas'))->setPaper('a4', 'landscape');

        // Descargar el archivo PDF
        return $pdf->download('reporte_ventas.pdf');
    } 


    // Método para mostrar la vista con el gráfico -------------------------------------------------
    public function showVentasChart()
    {
        // Obtener las ventas del último año
        $ventas = Ventasproducto::whereYear('fecha', Carbon::now()->year)
            ->get();

        // Inicializar un arreglo para almacenar las ventas mensuales
        $ventasMensuales = array_fill(0, 12, 0); // Crear un array con 12 elementos, todos en 0

        // Organizar las ventas por mes
        foreach ($ventas as $venta) {
            $mes = Carbon::parse($venta->fecha)->month - 1; // Obtener el mes (0-11)
            $ventasMensuales[$mes] += $venta->total; // Sumar las ventas del mes correspondiente
        }

        // Pasar los datos a la vista
        return view('ventasproductos.chart', compact('ventasMensuales'));
    }

    // Predecir ventas
    public function predecirVentas(Request $request)
    {
        // Obtener las ventas con los detalles y productos relacionados
        $ventas = Ventasproducto::with('detalles.producto')->get();

        // Preparar los datos para enviar al script Python
        $data = [];
        foreach ($ventas as $venta) {
            foreach ($venta->detalles as $detalle) {
                // Validar que los datos no sean nulos
                if ($detalle->producto && $venta->created_at && $detalle->cantidad) {
                    $data[] = [
                        'producto_id' => $detalle->producto_id,
                        'producto_nombre' => $detalle->producto->nombre ?? 'Desconocido',
                        'cantidad_vendida' => $detalle->cantidad,
                        'año' => $venta->created_at->year,
                        'mes' => $venta->created_at->month,
                    ];
                }
            }
        }

        // Validar si hay datos
        if (empty($data)) {
            return response()->json(['error' => 'No hay datos suficientes para realizar la predicción.'], 400);
        }

        // Convertir los datos a JSON
        $jsonData = json_encode($data);

        // Ejecutar el script Python
        $scriptPath = base_path('scripts/prediccion.py'); // Ruta al script Python
        $process = new Process(['python', $scriptPath, $jsonData]);

        try {
            $process->mustRun();
            $output = $process->getOutput();
            $response = json_decode($output, true);

            // Validar la respuesta del script Python
            if (isset($response['error'])) {
                return response()->json(['error' => $response['error']], 500);
            }

            return response()->json(['prediccion' => $response['prediccion']]);
        } catch (ProcessFailedException $e) {
            return response()->json(['error' => 'Error al ejecutar el script Python: ' . $e->getMessage()], 500);
        }
    }



    public function generarFactura($id)
    {
        // Obtener la venta y sus detalles
        $venta = VentasProducto::with('detalles.producto')->findOrFail($id);

        // Preparar los datos para la factura
        $data = [
            'venta' => $venta,
            'detalles' => $venta->detalles,
        ];

        // Generar el PDF
        $pdf = PDF::loadView('facturas.ventas', $data);

        // Descargar el archivo PDF
        return $pdf->download("factura_venta_{$venta->id}.pdf");
    }




    public function mostrarFactura($ventaId)
    {
        $venta = VentasProducto::find($ventaId);  // Obtén la venta desde la base de datos
        $detalles = $venta->detalles;    // Obtén los detalles de la venta

        return view('facturas.index', compact('venta', 'detalles'));
    }

    // Generar y descargar el PDF de la factura
    public function descargarFactura($ventaId)
    {
        $venta = VentasProducto::find($ventaId);  // Obtén la venta desde la base de datos
        $detalles = $venta->detalles;    // Obtén los detalles de la venta

        $pdf = PDF::loadView('facturas.ventas', compact('venta', 'detalles'));
        return $pdf->download('factura_'.$venta->id.'.pdf');
    }
}
