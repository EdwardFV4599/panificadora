<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['materia_prima','proveedor','existencia_agregada','precio','encargado','fecha','descripcion','estado'];
    public $timestamps = true;
}
