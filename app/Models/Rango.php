<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rango extends Model
{
    use HasFactory;
    protected $fillable = [
        'nivel',
        'descuento',
        'compras_minimas',
    ];

    //relacion uno a muchos 
    public function promotor(){
        return $this->hasMany(Promotor::class);
    }


}
