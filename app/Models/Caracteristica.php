<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = [
        'valor',
        'descripcion',
        'opcion_id'
    ];

    //relacion uno a muchos inversa
    public function opcions(){
        return $this->belongsTo(Opcion::class);
    }

    //relacion muchos a muchos 
    public function variantes(){
        return $this->belongsToMany(Variante::class)
                    ->withTimestamps();
    }
}
