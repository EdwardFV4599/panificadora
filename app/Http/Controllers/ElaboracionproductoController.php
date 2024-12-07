<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Insumo;
use App\Models\Elaboracionproducto;

class ElaboracionproductoController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $productos = Producto::where('estado', 1)->get();
        $categorias = Categoria::all();
        return view('elaboracionproductos.index', compact('categorias', 'productos'));
    }

    // Ver detalles
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $historial = Elaboracionproducto::where('producto', $id)->get();

        return view('elaboracionproductos.show', compact('producto', 'historial'));
    }

    // Formulario para agregar
    public function create($id)
    {
        $producto = Producto::findOrFail($id);
        return view('elaboracionproductos.create', compact('producto'));
    }

    // Guardar elaboración
    public function store(Request $request, $id)
    {
        $request->validate([
            'cantidad_elaborada' => 'required|numeric|min:1',
        ]);

        $producto = Producto::findOrFail($id);

        // Registrar elaboración
        Elaboracionproducto::create([
            'producto' => $producto->id,
            'cantidad_elaborada' => $request->cantidad_elaborada,
            'fecha' => now(),
            'estado' => 1,
        ]);

        // Descontar insumos (ejemplo simplificado)
        $insumosConsumidos = [
            // Asocia insumos con la cantidad consumida por producto.
            1 => 0.5, // Harina de trigo: 0.5 kg por unidad
            2 => 0.1, // Azúcar: 0.1 kg por unidad
        ];

        foreach ($insumosConsumidos as $insumoId => $cantidadPorUnidad) {
            $insumo = Insumo::find($insumoId);
            $insumo->stock_actual -= $cantidadPorUnidad * $request->cantidad_elaborada;
            $insumo->save();
        }

        // Actualizar stock del producto
        $producto->stock_actual += $request->cantidad_elaborada;
        $producto->save();

        return redirect()->route('elaboracionproductos.index')->with('success', 'Elaboración registrada exitosamente.');
    }
}
