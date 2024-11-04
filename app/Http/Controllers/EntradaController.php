<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\MateriaPrima;
use App\Models\Proveedor;

class EntradaController extends Controller
{
    // Mostrar la lista
    public function index(Request $request)
    {
        $entradas = Entrada::where('estado', 1)->get();
        $materiasPrimas = MateriaPrima::all();
        $proveedores = Proveedor::all();
        return view('entradas.index', compact('entradas', 'materiasPrimas', 'proveedores'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $entradas = Entrada::all();
        $materiasPrimas = MateriaPrima::all();
        $proveedores = Proveedor::all();
        return view('entradas.create', compact('entradas', 'materiasPrimas', 'proveedores'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'existencia_agregada' => 'required|numeric',
            'precio' => 'required|numeric',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        $entrada = new Entrada();
        $entrada->materia_prima = $request->materia_prima;
        $entrada->proveedor = $request->proveedor;
        $entrada->existencia_agregada = $request->existencia_agregada;
        $entrada->precio = $request->precio;
        $entrada->encargado = $request->encargado;
        $entrada->fecha = $request->fecha;
        $entrada->descripcion = $request->descripcion;
        $entrada->estado = 1;
        $entrada->save();

        $id = $request->materia_prima;
        $materiaPrima = MateriaPrima::find($id);
        $materiaPrima->existencia_actual = $materiaPrima->existencia_actual + $request->existencia_agregada;
        $materiaPrima->save();
        return redirect()->route('entradas.index')->with('success', 'Entrada creada correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Request $request,string $id)
    {
        $entrada = Entrada::find($id);
        $materiasPrimas = MateriaPrima::all();
        $proveedores = Proveedor::all();
        return view('entradas.edit', compact('entrada', 'id', 'materiasPrimas', 'proveedores'));
    }

    // Actualizar en la base de datos
    public function update(Request $request, string $id)
    {
        $request->validate([
            'existencia_agregada' => 'required|numeric',
            'precio' => 'required|numeric',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        $entrada = Entrada::find($id);
        {
            $id = $entrada->materia_prima;
            $materiaPrima = MateriaPrima::find($id);
            $materiaPrima->existencia_actual = $materiaPrima->existencia_actual - $entrada->existencia_agregada;
            $materiaPrima->save();
        }
        $entrada->materia_prima = $request->materia_prima;
        $entrada->proveedor = $request->proveedor;
        $entrada->existencia_agregada = $request->existencia_agregada;
        $entrada->precio = $request->precio;
        $entrada->encargado = $request->encargado;
        $entrada->fecha = $request->fecha;
        $entrada->descripcion = $request->descripcion;
        $entrada->save();

        $idNueva = $request->materia_prima;
        $materiaPrimaNueva = MateriaPrima::find($idNueva);
        $materiaPrimaNueva->existencia_actual = $materiaPrimaNueva->existencia_actual + $request->existencia_agregada;
        $materiaPrimaNueva->save();
        return redirect()->route('entradas.index')->with('success', 'Entrada actualizada correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $entrada = Entrada::find($id);
        $entrada->estado = 0;
        $entrada->save();

        $id = $entrada->materia_prima;
        $materiaPrima = MateriaPrima::find($id);
        $materiaPrima->existencia_actual = $materiaPrima->existencia_actual - $entrada->existencia_agregada;
        $materiaPrima->save();
        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada correctamente.');
    }
}
