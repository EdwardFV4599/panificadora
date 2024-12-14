<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VentaTiempo;

class VentastiempoController extends Controller
{
    public function iniciarTemporizador()
    {
        // Generar un código de venta único
        $codigoVenta = uniqid('venta_');
        $fechaVenta = now();

        // Guardar el tiempo inicial
        VentaTiempo::create([
            'codigo_venta' => $codigoVenta,
            'fecha_venta' => $fechaVenta,
            'tiempo_inicial' => $fechaVenta
        ]);

        return response()->json(['codigo_venta' => $codigoVenta, 'fecha_venta' => $fechaVenta]);
    }

    public function finalizarTemporizador(Request $request)
    {
        // Suponemos que recibes el código de venta desde el frontend
        $ventaTiempo = VentaTiempo::where('codigo_venta', $request->codigo_venta)->first();

        if ($ventaTiempo) {
            $ventaTiempo->tiempo_final = now();
            $ventaTiempo->duracion = $ventaTiempo->tiempo_inicial->diffInSeconds($ventaTiempo->tiempo_final);
            $ventaTiempo->save();
        }

        // Aquí va la lógica de guardar la venta
        // Venta::create($request->all());

        return response()->json(['message' => 'Venta registrada con éxito']);
    }
}
