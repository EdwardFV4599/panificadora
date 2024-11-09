<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['nombre','ruc','correo','telefono','direccion','descripcion','estado'];
    public $timestamps = true;
}
