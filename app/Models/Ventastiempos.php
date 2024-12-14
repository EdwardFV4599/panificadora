<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventastiempos extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'ventastiempos';

    // Los atributos que se pueden asignar de manera masiva
    protected $fillable = [
        'codigo_venta',
        'fecha_venta',
        'tiempo_inicial',
        'tiempo_final',
        'duracion',
    ];

    // Indicamos que 'tiempo_inicial' y 'tiempo_final' son fechas
    protected $dates = [
        'tiempo_inicial',
        'tiempo_final',
    ];

    // Opcional: Si quieres personalizar el formato de las fechas
    protected $dateFormat = 'Y-m-d H:i:s';
}
