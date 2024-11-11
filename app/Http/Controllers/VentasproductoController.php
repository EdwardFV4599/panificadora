<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventasproducto;
use App\Models\Producto;
use App\Models\Ventasproductodetalle;
use Carbon\Carbon;

class VentasproductoController extends Controller
{
    // Mostrar la lista de ventas
    public function index(Request $request)
    {
        $ventasproductos = Ventasproducto::where('estado', 1)->get();
        return view('ventasproductos.index', compact('ventasproductos'));
    }

    // Mostrar el formulario para crear una nueva venta
    public function create()
    {
        $productos = Producto::where('estado', 1)->get();  // Solo productos activos
        return view('ventasproductos.create', compact('productos'));
    }

    // Guardar una nueva venta
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'cliente' => 'required|string',
            'detalles' => 'required|array|min:1',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.precio' => 'required|numeric',
        ]);

        // Calcular el total de la venta antes de crear el registro
        $totalVenta = 0;
        foreach ($request->detalles as $detalle) {
            $totalVenta += $detalle['cantidad'] * $detalle['precio'];  // Sumar el total de cada producto
        }

        // Crear la venta
        $venta = Ventasproducto::create([
            'fecha' => $request->fecha,
            'cliente' => $request->cliente,
            'total' => $totalVenta,  // Asignar el total calculado
            'descripcion' => $request->descripcion ?? null,
            'estado' => 1,
        ]);

        // Guardar los detalles de la venta y actualizar stock de los productos
        foreach ($request->detalles as $detalle) {
            $producto = Producto::find($detalle['producto_id']);
            if ($producto && $producto->stock_actual >= $detalle['cantidad']) {
                Ventasproductodetalle::create([
                    'ventasproducto_id' => $venta->id,
                    'producto_id' => $detalle['producto_id'],
                    'cantidad' => $detalle['cantidad'],
                    'precio' => $detalle['precio'],
                    'estado' => 1,  // Asegúrate de establecer el valor de 'estado'
                ]);                
        
                // Actualizar el stock del producto
                $producto->decrement('stock_actual', $detalle['cantidad']);
            } else {
                return back()->withErrors(['error' => 'Stock insuficiente para algunos productos']);
            }
        }        

        return redirect()->route('ventasproductos.index')->with('success', '');
    }

    // Mostrar el formulario para editar una venta
    public function edit(Request $request, $id)
    {
        $venta = Ventasproducto::findOrFail($id);
        $productos = Producto::where('estado', 1)->get();
        return view('ventasproductos.edit', compact('venta', 'productos'));
    }

    // Actualizar una venta en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cliente' => 'required|string',
            'total' => 'required|numeric',
            'detalles' => 'required|array|min:1',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.precio' => 'required|numeric',
        ]);

        // Recuperar la venta
        $venta = Ventasproducto::findOrFail($id);

        // Primero, revertir el stock de los productos anteriores
        foreach ($venta->detalles as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->increment('stock_actual', $detalle->cantidad);
        }

        // Actualizar la venta
        $venta->update([
            'fecha' => $request->fecha,
            'cliente' => $request->cliente,
            'total' => $request->total,
            'descripcion' => $request->descripcion ?? null,
        ]);

        // Eliminar los detalles previos
        $venta->detalles()->delete();

        // Guardar los nuevos detalles y actualizar el stock
        foreach ($request->detalles as $detalle) {
            $producto = Producto::find($detalle['producto_id']);
            if ($producto && $producto->stock_actual >= $detalle['cantidad']) {
                Ventasproductodetalle::create([
                    'ventasproducto_id' => $venta->id,
                    'producto_id' => $detalle['producto_id'],
                    'cantidad' => $detalle['cantidad'],
                    'precio' => $detalle['precio'],
                    'estado' => 1,  // Asegúrate de establecer el valor de 'estado'
                ]);                

                // Actualizar el stock del producto
                $producto->decrement('stock_actual', $detalle['cantidad']);
            } else {
                return back()->withErrors(['error' => 'Stock insuficiente para algunos productos']);
            }
        }

        return redirect()->route('ventasproductos.index')->with('success', '');
    }

    // Eliminar una venta (soft delete)
    public function destroy($id)
    {
        $venta = Ventasproducto::findOrFail($id);
        $venta->estado = 0;  // Marcamos la venta como eliminada
        $venta->save();

        // Revertir el stock de los productos
        foreach ($venta->detalles as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->increment('stock_actual', $detalle->cantidad);
        }

        return redirect()->route('ventasproductos.index')->with('success', '');
    }



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
    
    
    // Método para obtener las ventas desde la base de datos
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
    
}
