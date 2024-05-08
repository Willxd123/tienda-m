<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;

    //asignacion masiva para los controladores
    protected $fillable = [
        'nombre',
    ];
    //relacion uno a muchos
    public function categorias(){
        return $this->hasMany(Categoria::class);
    }
}
