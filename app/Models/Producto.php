<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['nombre','categoria','stock_actual','precio','descripcion','estado'];
    public $timestamps = true;
}
