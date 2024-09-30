<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{
    // Mostrar la lista de materias primas
    public function index(Request $request)
    {
        // $materiasPrimas = MateriaPrima::all();
        $materiasPrimas = MateriaPrima::where('eliminado', 0)->get();
        return view('materia_primas.index', compact('materiasPrimas'));
    }

    // Mostrar el formulario para crear una nueva materia prima
    public function create()
    {
        $materiasPrimas = MateriaPrima::all();
        return view('materia_primas.create', compact('materiasPrimas'));
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
    public function edit(Request $request,string $id)
    {
        $materiaPrima = MateriaPrima::find($id);
        return view('materia_primas.edit', compact('materiaPrima', 'id'));
    }

    // Actualizar la materia prima en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|numeric',
            'unidad' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable'
        ]);

        $materiaPrima = MateriaPrima::find($id);
        $materiaPrima->update($request->all());
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima actualizada correctamente.');
    }

    // Eliminar una materia prima de la base de datos
    public function destroy($id)
    {
        $materiaPrima = MateriaPrima::find($id);
        $materiaPrima->eliminado = 1;
        $materiaPrima->save();
        return redirect()->route('materia_primas.index')->with('success', 'Materia prima eliminada correctamente.');
    }
}
