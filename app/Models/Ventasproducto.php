<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventasproducto extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'total', 'cliente', 'descripcion', 'estado'];

    public function detalles()
    {
        return $this->hasMany(Ventasproductodetalle::class);
    }
}
