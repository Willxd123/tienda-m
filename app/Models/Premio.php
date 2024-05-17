<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion' ,
        'imagen' ,
        'precio_puntos',
    ];

    //relacion uno a muchos inversa
    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    //relacion muchos a muchos 
    public function promotors(){
        return $this->belongsToMany(Promotor::class, 'pemio_promotors');
    }
}
