<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = [
        'imagen',
        'producto_id'
    ];

    //relacion uno a muchos inversa
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
    //relacion muchos a muchos 
    public function caracteristicas(){
        return $this->belongsToMany(Caracteristica::class)
                    ->withTimestamps();
    }
}
