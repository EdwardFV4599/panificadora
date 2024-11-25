<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $productos = Producto::where('estado', 1)->get();
        $categorias = Categoria::all();
        return view('productos.index', compact('productos','categorias'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        return view('productos.create', compact('productos','categorias'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'categoria' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable'
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->existencia_actual = 0;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->estado = 1;
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'id', 'categorias'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'categoria' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable'
        ]);

        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->existencia_actual = 0;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar (soft delete)
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->estado = 0;
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
