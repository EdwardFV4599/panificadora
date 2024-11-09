<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriaPrima;

class MateriaPrimaController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $materiasPrimas = MateriaPrima::where('estado', 1)->get();
        return view('materia_primas.index', compact('materiasPrimas'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $materiasPrimas = MateriaPrima::all();
        return view('materia_primas.create', compact('materiasPrimas'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'unidad' => 'required',
            'descripcion' => 'nullable'
        ]);

        $materiaPrima = new MateriaPrima();
        $materiaPrima->nombre = $request->nombre;
        $materiaPrima->existencia_actual = 0;
        $materiaPrima->unidad = $request->unidad;
        $materiaPrima->descripcion = $request->descripcion;
        $materiaPrima->estado = 1;
        $materiaPrima->save();
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima creada correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $materiaPrima = MateriaPrima::find($id);
        return view('materia_primas.edit', compact('materiaPrima', 'id'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'unidad' => 'required',
            'descripcion' => 'nullable'
        ]);

        $materiaPrima = MateriaPrima::find($id);
        $materiaPrima->nombre = $request->nombre;
        $materiaPrima->existencia_actual = $request->existencia_actual;
        $materiaPrima->unidad = $request->unidad;
        $materiaPrima->descripcion = $request->descripcion;
        $materiaPrima->save();
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima actualizada correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $materiaPrima = MateriaPrima::find($id);
        $materiaPrima->estado = 0;
        $materiaPrima->save();
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima eliminada correctamente.');
    }
}
