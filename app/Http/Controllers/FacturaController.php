<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventasproducto;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
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

    // Mostrar la factura ------------------------------------------------
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
