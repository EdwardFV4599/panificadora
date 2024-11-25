<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
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

    // Mostrar el formulario para crear
    public function create()
    {
        $elaboracionproductos = Elaboracionproducto::all();
        $categorias = Categoria::all();
        return view('elaboracionproductos.create', compact('elaboracionproductos','categorias'));
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

        $producto = new Elaboracionproducto();
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->stock_actual = 0;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->estado = 1;
        $producto->save();
        return redirect()->route('elaboracionproductos.index')->with('success', '');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $producto = Elaboracionproducto::find($id);
        $categorias = Categoria::all();
        return view('elaboracionproductos.edit', compact('producto', 'id', 'categorias'));
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

        $producto = Elaboracionproducto::find($id);
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->stock_actual = 0;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->save();
        return redirect()->route('elaboracionproductos.index')->with('success', '');
    }

    // Eliminar (soft delete)
    public function destroy($id)
    {
        $producto = Elaboracionproducto::find($id);
        $producto->estado = 0;
        $producto->save();
        return redirect()->route('elaboracionproductos.index')->with('success', '');
    }
}
