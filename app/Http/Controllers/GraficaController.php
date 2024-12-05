<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentasProductoDetalle;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GraficaController extends Controller
{
    public function mostrarGraficas()
    {
        return view('graficas.ventas_graficas');
    }

    public function obtenerVentas(Request $request)
    {
        try {
            // Obtener parámetros de entrada
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFinal = $request->input('fecha_final');
            $periodo = $request->input('periodo', 'mes');

            // Validar entradas
            if (!$fechaInicio || !$fechaFinal) {
                return response()->json(['error' => 'Las fechas son obligatorias'], 400);
            }

            // Crear consulta dinámica según el período
            $query = VentasProductoDetalle::with('producto')  // Cargar la relación de producto
                ->selectRaw('producto_id, SUM(cantidad) as total_cantidad, SUM(cantidad * precio) as total_precio');

            if ($periodo === 'dia') {
                $query->addSelect(DB::raw('DATE(vp.fecha) as periodo'))
                    ->groupBy('producto_id', 'periodo');
            } elseif ($periodo === 'semana') {
                $query->addSelect(DB::raw('YEARWEEK(vp.fecha, 1) as periodo'))
                    ->groupBy('producto_id', 'periodo');
            } else {
                $query->addSelect(DB::raw('MONTH(vp.fecha) as periodo'))
                    ->groupBy('producto_id', 'periodo');
            }

            $query->join('ventasproductos as vp', 'ventasproductodetalles.ventasproducto_id', '=', 'vp.id')
                ->whereBetween('vp.fecha', [$fechaInicio, $fechaFinal]);

            $ventas = $query->get();

            // Organizar datos por producto y período
            $data = [];
            foreach ($ventas as $venta) {
                $productoId = $venta->producto_id;
                $productoNombre = $venta->producto->nombre;  // Obtener nombre del producto a través de la relación
                $periodoKey = $venta->periodo;

                $data[$productoId]['nombre'] = $productoNombre;
                $data[$productoId]['ventas'][$periodoKey] = $venta->total_precio;
            }

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error("Error en obtenerVentas: {$e->getMessage()}", ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}
