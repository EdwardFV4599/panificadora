<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprasinsumo;
use App\Models\Insumo;
use App\Models\Proveedor;

class ComprasinsumoController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $comprasinsumos = Comprasinsumo::where('estado', 1)->get();
        $insumos = Insumo::all();
        $proveedores = Proveedor::all();
        return view('comprasinsumos.index', compact('comprasinsumos', 'insumos', 'proveedores'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $comprasinsumos = Comprasinsumo::all();
        $insumos = Insumo::all();
        $proveedores = Proveedor::all();
        return view('comprasinsumos.create', compact('comprasinsumos', 'insumos', 'proveedores'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'stock_agregado' => 'required|numeric',
            'precio' => 'required|numeric',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        $comprasinsumo = new Comprasinsumo();
        $comprasinsumo->insumo = $request->insumo;
        $comprasinsumo->proveedor = $request->proveedor;
        $comprasinsumo->stock_agregado = $request->stock_agregado;
        $comprasinsumo->precio = $request->precio;
        $comprasinsumo->encargado = $request->encargado;
        $comprasinsumo->fecha = $request->fecha;
        $comprasinsumo->descripcion = $request->descripcion;
        $comprasinsumo->estado = 1;
        $comprasinsumo->save();

        $id = $request->insumo;
        $insumo = Insumo::find($id);
        $insumo->stock_actual = $insumo->stock_actual + $request->stock_agregado;
        $insumo->save();
        return redirect()->route('comprasinsumos.index')->with('success', '');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $comprasinsumo = Comprasinsumo::find($id);
        $insumos = Insumo::all();
        $proveedores = Proveedor::all();
        return view('comprasinsumos.edit', compact('comprasinsumo', 'id', 'insumos', 'proveedores'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'stock_agregado' => 'required|numeric',
            'precio' => 'required|numeric',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        $comprasinsumo = Comprasinsumo::find($id);
        {
            $id = $comprasinsumo->insumo;
            $insumo = Insumo::find($id);
            $insumo->stock_actual = $insumo->stock_actual - $comprasinsumo->stock_agregado;
            $insumo->save();
        }
        $comprasinsumo->insumo = $request->insumo;
        $comprasinsumo->proveedor = $request->proveedor;
        $comprasinsumo->stock_agregado = $request->stock_agregado;
        $comprasinsumo->precio = $request->precio;
        $comprasinsumo->encargado = $request->encargado;
        $comprasinsumo->fecha = $request->fecha;
        $comprasinsumo->descripcion = $request->descripcion;
        $comprasinsumo->save();

        $idnueva = $request->insumo;
        $insumonuevo = Insumo::find($idnueva);
        $insumonuevo->stock_actual = $insumonuevo->stock_actual + $request->stock_agregado;
        $insumonuevo->save();
        return redirect()->route('comprasinsumos.index')->with('success', '');
    }

    // Eliminar
    public function destroy($id)
    {
        $comprasinsumo = Comprasinsumo::find($id);
        $comprasinsumo->estado = 0;
        $comprasinsumo->save();

        $id = $comprasinsumo->insumo;
        $insumo = Insumo::find($id);
        $insumo->stock_actual = $insumo->stock_actual - $comprasinsumo->stock_agregado;
        $insumo->save();
        return redirect()->route('comprasinsumos.index')->with('success', '');
    }
}