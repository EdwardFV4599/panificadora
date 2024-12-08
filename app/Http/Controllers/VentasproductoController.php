<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventasproducto;
use App\Models\Producto;
use App\Models\Ventasproductodetalle;
use Illuminate\Support\Facades\DB;

class VentasproductoController extends Controller
{
    // Mostrar lista
    public function index(Request $request)
    {
        $ventasproductos = Ventasproducto::where('estado', 1)->get();
        return view('ventasproductos.index', compact('ventasproductos'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $productos = Producto::where('estado', 1)->get();  // Solo productos activos
        return view('ventasproductos.create', compact('productos'));
    }

    // Guardar en la base de datos
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

        try {
            // Ejecutar la operación dentro de una transacción
            DB::transaction(function () use ($request) {
                // Calcular el total de la venta
                $totalVenta = 0;
                foreach ($request->detalles as $detalle) {
                    $totalVenta += $detalle['cantidad'] * $detalle['precio'];
                }

                // Crear la venta
                $venta = Ventasproducto::create([
                    'fecha' => $request->fecha,
                    'cliente' => $request->cliente,
                    'total' => $totalVenta,
                    'estado' => 1,
                ]);

                // Validar stock y guardar los detalles
                foreach ($request->detalles as $detalle) {
                    if (empty($detalle['producto_id']) || empty($detalle['cantidad']) || empty($detalle['precio'])) {
                        return back()->withErrors(['error' => 'Hay campos vacíos en los detalles de la venta']);
                    }
                
                    $producto = Producto::find($detalle['producto_id']);
                    if ($producto && $producto->stock_actual >= $detalle['cantidad']) {
                        Ventasproductodetalle::create([
                            'ventasproducto_id' => $venta->id,
                            'producto_id' => $detalle['producto_id'],
                            'cantidad' => $detalle['cantidad'],
                            'precio' => $detalle['precio'],
                            'estado' => 1, 
                        ]);
                
                        $producto->decrement('stock_actual', $detalle['cantidad']);
                    } else {
                        return back()->withErrors(['error' => 'Stock insuficiente para algunos productos']);
                    }
                }
            });

            // Si todo va bien, redirigir con éxito
            return redirect()->route('ventasproductos.index')->with('success', 'Venta registrada correctamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Mostrar el formulario para editar
    public function edit(Request $request, $id)
    {
        $venta = Ventasproducto::findOrFail($id);
        $productos = Producto::where('estado', 1)->get();
        return view('ventasproductos.edit', compact('venta', 'productos'));
    }

    // Actualizar en la base de datos
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

    // Eliminar (soft delete)
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
}