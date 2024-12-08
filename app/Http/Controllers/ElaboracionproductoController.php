<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Insumo;
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

    // Ver detalles
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $historial = ElaboracionProducto::where('producto', $id)
                                        ->where('estado', 1)
                                        ->get();
        return view('elaboracionproductos.show', compact('producto', 'historial'));
    }

    // Formulario para agregar
    public function create($id)
    {
        $producto = Producto::findOrFail($id);
        return view('elaboracionproductos.create', compact('producto'));
    }

    // Guardar elaboración
    public function store(Request $request, $id)
    {
        $request->validate([
            'cantidad_elaborada' => 'required|numeric|min:1',
        ]);

        $producto = Producto::findOrFail($id);

        // Registrar elaboración
        ElaboracionProducto::create([
            'producto' => $producto->id,
            'cantidad_elaborada' => $request->cantidad_elaborada,
            'fecha' => now(),
            'estado' => 1,
        ]);

        // Descontar insumos específicos según el producto
        $cantidadElaborada = $request->cantidad_elaborada;

        switch ($producto->nombre) {
            case 'Pan francés':
                $insumos = [
                    'Harina de trigo' => 0.5,
                    'Levadura' => 0.1,
                    'Sal' => 0.05,
                    'Agua' => 0.2,
                ];
                break;

            case 'Pan de yema':
                $insumos = [
                    'Harina de trigo' => 0.4,
                    'Azúcar' => 0.2,
                    'Huevos' => 2,
                    'Leche' => 0.2,
                    'Sal' => 0.05,
                    'Agua' => 0.2,
                ];
                break;

            case 'Pan integral':
                $insumos = [
                    'Harina integral' => 0.5,
                    'Levadura' => 0.1,
                    'Sal' => 0.05,
                    'Avena' => 0.2,
                    'Agua' => 0.2,
                ];
                break;

            case 'Torta de manzana':
                $insumos = [
                    'Harina de trigo' => 0.4,
                    'Azúcar' => 0.3,
                    'Manzanas' => 0.5,
                    'Leche' => 0.2,
                    'Huevos' => 2,
                    'Canela' => 0.05,
                ];
                break;

            case 'Torta de fresa':
                $insumos = [
                    'Harina de trigo' => 0.3,
                    'Azúcar' => 0.3,
                    'Leche' => 0.3,
                    'Huevos' => 2,
                    'Fresas' => 0.5,
                    'Crema de leche' => 0.2,
                ];
                break;

            case 'Torta de tres leches':
                $insumos = [
                    'Leche condensada' => 0.2,
                    'Leche' => 0.3,
                    'Crema de leche' => 0.3,
                    'Azúcar' => 0.3,
                    'Huevos' => 2,
                ];
                break;

            case 'Torta de chocolate':
                $insumos = [
                    'Harina de trigo' => 0.4,
                    'Chocolate' => 0.3,
                    'Azúcar' => 0.2,
                    'Leche' => 0.2,
                    'Mantequilla' => 0.2,
                    'Huevos' => 2,
                ];
                break;

            case 'Galletas de chocolate':
                $insumos = [
                    'Harina de trigo' => 0.4,
                    'Chocolate' => 0.2,
                    'Azúcar' => 0.2,
                    'Mantequilla' => 0.3,
                    'Huevos' => 2,
                    'Leche' => 0.2,
                    'Avena' => 0.2,
                ];
                break;

            case 'Galletas de avena':
                $insumos = [
                    'Harina de trigo' => 0.3,
                    'Azúcar' => 0.3,
                    'Mantequilla' => 0.3,
                    'Avena' => 0.4,
                    'Leche' => 0.2,
                    'Huevos' => 2,
                ];
                break;

            default:
                $insumos = [];
                break;
        }

        // Descontar los insumos calculados
        foreach ($insumos as $nombreInsumo => $cantidadPorUnidad) {
            $insumo = Insumo::where('nombre', $nombreInsumo)->first();
            if ($insumo) {
                $insumo->stock_actual -= $cantidadPorUnidad * $cantidadElaborada;
                $insumo->save();
            }
        }

        // Actualizar stock del producto
        $producto->stock_actual += $cantidadElaborada;
        $producto->save();

        return redirect()->route('elaboracionproductos.index')->with('success', 'Elaboración registrada exitosamente.');
    }


    // Cancelar (soft delete)
    public function cancelar($id)
    {
        $registro = ElaboracionProducto::findOrFail($id);
        $registro->estado = 0; // Cambiar el estado a 0 para indicar cancelado
        $registro->save();

        return redirect()->back()->with('success', 'Elaboración cancelada correctamente.');
    }
}
