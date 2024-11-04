<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['nombre', 'existencia_actual', 'unidad', 'precio', 'descripcion', 'estado'];
    public $timestamps = true;
}
