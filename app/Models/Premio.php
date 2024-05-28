<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Premio extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock',
        'precio_puntos',
        'producto_id',
    ];

    //relacion uno a muchos inversa
    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
       

    }
    //relacion muchos a muchos 
    public function promotors(){
        return $this->belongsToMany(Promotor::class, 'pemio_promotors');
    }
}
