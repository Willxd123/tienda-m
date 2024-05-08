<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = [
        'nombre',
        'categoria_id'
    ];

    //relacion uno a muchos inversa
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    //relacion uno a muchos
    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
