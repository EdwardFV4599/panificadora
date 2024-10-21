<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['nombre', 'categoria', 'existencia_actual',  'precio', 'descripcion', 'eliminado'];
    public $timestamps = true;
}
