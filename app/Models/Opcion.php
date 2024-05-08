<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = [
        'nombre',
        'tipo'
    ];

    //relacion muchos a muchos 
    public function productos(){
        return $this->belongsToMany(Producto::class)
                    ->withPivot('valor')
                    ->withTimestamps();
    }
    //relacion uno a muchos
    public function caracteristicas(){
        return $this->hasMany(Caracteristica::class);
    }
}
