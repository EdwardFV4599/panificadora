<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;

class EntradaController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $entradas = Entrada::where('eliminado', 0)->get();
        return view('entradas.index', compact('entradas'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $entradas = Entrada::all();
        return view('entradas.create', compact('entradas'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required',
            'proveedor' => 'required',
            'existencia_inicial' => 'required',
            'precio' => 'required|numeric',
            'encargado' => 'required',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        Entrada::create($request->all());
        return redirect()->route('entradas.index')->with('success', 'Entrada creada correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $entrada = Entrada::find($id);
        return view('entradas.edit', compact('entrada', 'id'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'producto' => 'required',
            'proveedor' => 'required',
            'existencia_inicial' => 'required',
            'precio' => 'required|numeric',
            'encargado' => 'required',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        $entrada = Entrada::find($id);
        $entrada->update($request->all());
        return redirect()->route('entradas.index')->with('success', 'Entrada actualizada correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $entrada = Entrada::find($id);
        $entrada->eliminado = 1;
        $entrada->save();
        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada correctamente.');
    }
}
