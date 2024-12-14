<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventastiempo extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'ventastiempos';

    // Los atributos que se pueden asignar de manera masiva
    protected $fillable = [
        'codigo_venta',
        'fecha',
        'hora_inicial',
        'hora_final',
        'duracion',
    ];

    // Indicamos que 'tiempo_inicial' y 'tiempo_final' son fechas
    protected $dates = [
        'hora_inicial',
        'hora_final',
    ];

    // Opcional: Si quieres personalizar el formato de las fechas
    protected $dateFormat = 'H:i:s';
}
