<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['producto', 'proveedor', 'existencia_inicial', 'existencia_actual', 'precio', 'encargado', 'fecha', 'descripcion','eliminado'];
    public $timestamps = true;
}
