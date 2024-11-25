<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentasProductoDetalle;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function generarReporte(Request $request)
    {
        $productoId = $request->input('producto_id'); // ID del producto seleccionado (opcional)
    
        // Obtener las ventas del producto o de todos los productos
        $ventasQuery = VentasProductoDetalle::selectRaw(
            'producto_id, MONTH(vp.fecha) as mes, SUM(cantidad) as total_cantidad, SUM(cantidad * precio) as total_precio'
        )
            ->join('ventasproductos as vp', 'ventasproductodetalles.ventasproducto_id', '=', 'vp.id')
            ->whereYear('vp.fecha', 2024);
    
        if ($productoId) {
            $ventasQuery->where('producto_id', $productoId);
        }
    
        $ventas = $ventasQuery->groupBy('producto_id', 'mes')->with('producto')->get();
    
        // Organizar los datos en un formato adecuado para el reporte
        $ventasPorMes = [];
        $totalGeneral = 0;
    
        foreach ($ventas as $venta) {
            $ventasPorMes[$venta->mes] = ($ventasPorMes[$venta->mes] ?? 0) + $venta->total_precio;
            $totalGeneral += $venta->total_precio;
        }
    
        // Si se genera un reporte para un producto específico, incluir el nombre
        $productoNombre = $productoId
            ? Producto::find($productoId)?->nombre ?? 'Producto no encontrado'
            : 'Todos los productos';
    
        $data = [
            'ventas' => $ventas,
            'productoNombre' => $productoNombre,
            'ventasPorMes' => $ventasPorMes,
            'totalGeneral' => $totalGeneral,
        ];
    
        $pdf = PDF::loadView('reportes.reporte_productos', $data);
    
        return $pdf->download("reporte_ventas_{$productoNombre}.pdf");
    }
}
