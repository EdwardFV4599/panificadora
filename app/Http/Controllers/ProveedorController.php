<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $proveedores = Proveedor::where('estado', 1)->get();
        return view('proveedores.index', compact('proveedores'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.create', compact('proveedores'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ruc' => 'required|numeric',
            'correo' => 'required',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'descripcion' => 'nullable'
        ]);

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->ruc = $request->ruc;
        $proveedor->correo = $request->correo;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->estado = 1;
        $proveedor->save();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedores.edit', compact('proveedor', 'id'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'ruc' => 'required|numeric',
            'correo' => 'required',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'descripcion' => 'nullable'
        ]);

        $proveedor = Proveedor::find($id);
        $proveedor->nombre = $request->nombre;
        $proveedor->ruc = $request->ruc;
        $proveedor->correo = $request->correo;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->save();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    // Eliminar (soft delete)
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->estado = 0;
        $proveedor->save();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}
