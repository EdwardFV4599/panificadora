<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprasinsumo;
use App\Models\Insumo;
use App\Models\Proveedor;

class ComprainsumoController extends Controller
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
        // Iniciar temporizador al acceder a la vista
        session(['compra_inicio' => now()]); // Guardamos el tiempo actual en la sesión
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

        // --------------------------------- TIMER -------------------------------------------
        // Recuperar el tiempo de inicio desde la sesión
        $tiempo_inicial = session('compra_inicio');
        $tiempo_final = now();

        // Calcular la duración en segundos
        $duracion = $tiempo_inicial->diffInSeconds($tiempo_final);

        // Convertir los tiempos creado con now() a formato solo hora
        $hora_inicial = $tiempo_inicial->format('H:i:s');
        $hora_final = $tiempo_final->format('H:i:s');

        // Registrar en la base de datos
        \DB::table('inventariostiempos')->insert([
            'codigo_compra' => $comprasinsumo->id,
            'fecha' => $comprasinsumo->fecha,
            'hora_inicial' => $hora_inicial,
            'hora_final' => $hora_final,
            'duracion' => $duracion,
            'error' => 0
        ]);
        // ------------------------------------------------------------------------------------

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

    // Eliminar (soft delete)
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
