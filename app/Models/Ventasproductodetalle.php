<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventasproductodetalle extends Model
{
    use HasFactory;

    protected $fillable = ['ventasproducto_id', 'producto_id', 'cantidad', 'precio', 'estado'];

    public function venta()
    {
        return $this->belongsTo(Ventasproducto::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
