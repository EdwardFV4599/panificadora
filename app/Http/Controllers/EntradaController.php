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
        $entradas = Entrada::where('eliminado', 0)->get();
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
            'existencia_agregada' => 'required',
            'precio' => 'required|numeric',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        Entrada::create($request->all());

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
            'existencia_agregada' => 'required',
            'precio' => 'required|numeric',
            'fecha' => 'required',
            'descripcion' => 'nullable'
        ]);

        $entrada = Entrada::find($id);
        $entrada->update($request->all());
        return redirect()->route('entradas.index')->with('success', 'Entrada actualizada correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $entrada = Entrada::find($id);
        $entrada->eliminado = 1;
        $entrada->save();

        $id = $entrada->materia_prima;
        $materiaPrima = MateriaPrima::find($id);
        $materiaPrima->existencia_actual = $materiaPrima->existencia_actual - $entrada->existencia_agregada;
        $materiaPrima->save();
        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada correctamente.');
    }
}
