<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotor extends Model
{
    use HasFactory;
    protected $fillable = [
        'telefono',
        'nit',
        'direccion' ,
        'rango_id' ,
        'puntos',
        'user_id' ,
    ];

    //relacion uno a muchos inversa
    public function rango(){
        return $this->belongsTo(Rango::class);
    }

    // Definimos la relación inversa, que es belongsTo
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion muchos a muchos 
    public function premios(){
        return $this->belongsToMany(Premio::class, 'pemio_promotors');
    }
}
