<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;

class InsumoController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $insumos = Insumo::where('estado', 1)->get();
        return view('insumos.index', compact('insumos'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $insumos = Insumo::all();
        return view('insumos.create', compact('insumos'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'unidad' => 'required',
            'descripcion' => 'nullable'
        ]);

        $insumo = new Insumo();
        $insumo->nombre = $request->nombre;
        $insumo->unidad = $request->unidad;
        $insumo->stock_actual = 0;
        $insumo->descripcion = $request->descripcion;
        $insumo->estado = 1;
        $insumo->save();
        return redirect()->route('insumos.index')->with('success', '');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $insumo = Insumo::find($id);
        return view('insumos.edit', compact('insumo', 'id'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'unidad' => 'required',
            'descripcion' => 'nullable'
        ]);

        $insumo = Insumo::find($id);
        $insumo->nombre = $request->nombre;
        $insumo->unidad = $request->unidad;
        $insumo->stock_actual = $request->stock_actual;
        $insumo->descripcion = $request->descripcion;
        $insumo->save();
        return redirect()->route('insumos.index')->with('success', '');
    }

    // Eliminar (soft delete)
    public function destroy($id)
    {
        $insumo = Insumo::find($id);
        $insumo->estado = 0;
        $insumo->save();
        return redirect()->route('insumos.index')->with('success', '');
    }
}
