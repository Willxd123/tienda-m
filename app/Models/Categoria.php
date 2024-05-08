<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = [
        'nombre',
        'familia_id',
    ];

    //relacion uno a muchos inversa
    public function familia(){
        return $this->belongsTo(Familia::class);
    }

    //relacion uno a muchos
    public function subcategorias(){
        return $this->hasMany(Subcategoria::class);
    }
}
