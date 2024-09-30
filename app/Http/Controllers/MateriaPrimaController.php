<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{
    // Mostrar la lista de materias primas
    public function index()
    {
        $materiasPrimas = MateriaPrima::all();
        return view('materia_primas.index', compact('materiasPrimas'));
    }

    // Mostrar el formulario para crear una nueva materia prima
    public function create()
    {
        return view('materia_primas.create');
    }

    // Guardar la nueva materia prima en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|numeric',
            'unidad' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable'
        ]);

        MateriaPrima::create($request->all());
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima creada correctamente.');
    }

    // Mostrar el formulario para editar una materia prima
    public function edit(MateriaPrima $materiaPrima)
    {
        return view('materia_primas.edit', compact('materiaPrima'));
    }

    // Actualizar la materia prima en la base de datos
    public function update(Request $request, MateriaPrima $materiaPrima)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|numeric',
            'unidad' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable'
        ]);

        $materiaPrima->update($request->all());
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima actualizada correctamente.');
    }

    // Eliminar una materia prima de la base de datos
    public function destroy(MateriaPrima $materiaPrima)
    {
        $materiaPrima->delete();
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima eliminada correctamente.');
    }
}
