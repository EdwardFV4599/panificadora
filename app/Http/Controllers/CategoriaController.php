<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $categorias = Categoria::where('eliminado', 0)->get();
        return view('categorias.index', compact('categorias'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $categorias = Categoria::all();
        return view('categorias.create', compact('categorias'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoria creada correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.edit', compact('categoria', 'id'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $categoria = Categoria::find($id);
        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->eliminado = 1;
        $categoria->save();
        return redirect()->route('categorias.index')->with('success', 'Categoria eliminada correctamente.');
    }
}
