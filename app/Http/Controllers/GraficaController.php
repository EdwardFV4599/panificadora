<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentasProductoDetalle;
use App\Models\Producto;
use Carbon\Carbon;

class GraficaController extends Controller
{
    public function ventasMensualesPorProducto()
    {
        // Obtener los datos de ventas por producto y mes para el año 2024
        $ventas = VentasProductoDetalle::selectRaw('producto_id, MONTH(vp.fecha) as mes, SUM(cantidad) as total_cantidad')
            ->join('ventasproductos as vp', 'ventasproductodetalles.ventasproducto_id', '=', 'vp.id')
            ->whereYear('vp.fecha', 2024)
            ->groupBy('producto_id', 'mes')
            ->get();

        // Organizar datos en un formato más fácil para los gráficos
        $productos = Producto::whereIn('id', $ventas->pluck('producto_id'))->get();

        $datos = [];
        foreach ($productos as $producto) {
            $datos[$producto->nombre] = array_fill(1, 12, 0); // Inicializa cada mes en 0
        }

        foreach ($ventas as $venta) {
            $producto = $productos->where('id', $venta->producto_id)->first();
            $datos[$producto->nombre][$venta->mes] = $venta->total_cantidad;
        }

        return response()->json($datos); // Devolver datos como JSON
    }

    public function mostrarGraficas()
    {
        return view('graficas.ventas_graficas');
    }

}
