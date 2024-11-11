<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprasinsumo extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['insumo','proveedor','stock_agregado','precio','encargado','fecha','descripcion','estado'];
    public $timestamps = true;
}
