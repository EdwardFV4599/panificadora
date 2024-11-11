<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['nombre','unidad', 'stock_actual','descripcion','estado'];
    public $timestamps = true;
}
