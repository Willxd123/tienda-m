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
        'user_id' ,

    ];

    // Definimos la relación inversa, que es belongsTo
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notaVentas(){
        return $this->hasMany(NotaVenta::class);
    }
}
