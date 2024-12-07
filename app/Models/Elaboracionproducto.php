<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elaboracionproducto extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable = ['producto','cantidad_elaborada','fecha','estado'];
    public $timestamps = true;

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto');
    }
}
