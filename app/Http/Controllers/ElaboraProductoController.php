<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElaboraProducto;
use App\Models\Categoria;
use App\Models\Producto;

class ElaboraProductoController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $elaboraproductos = ElaboraProducto::where('estado', 1)->get();
        $categorias = Categoria::all();
        $productos = Producto::all();
        return view('elaboraproductos.index', compact('elaboraproductos','categorias', 'productos'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $elaboraproductos = ElaboraProducto::all();
        $categorias = Categoria::all();
        return view('elaboraproductos.create', compact('elaboraproductos','categorias'));
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

        $producto = new ElaboraProducto();
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->existencia_actual = 0;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->estado = 1;
        $producto->save();
        return redirect()->route('elaboraproductos.index')->with('success', 'ElaboraProducto creado correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $producto = ElaboraProducto::find($id);
        $categorias = Categoria::all();
        return view('elaboraproductos.edit', compact('producto', 'id', 'categorias'));
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

        $producto = ElaboraProducto::find($id);
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->existencia_actual = 0;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->save();
        return redirect()->route('elaboraproductos.index')->with('success', 'ElaboraProducto actualizado correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $producto = ElaboraProducto::find($id);
        $producto->estado = 0;
        $producto->save();
        return redirect()->route('elaboraproductos.index')->with('success', 'ElaboraProducto eliminado correctamente.');
    }
}
