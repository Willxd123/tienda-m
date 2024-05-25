<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rango extends Model
{
    use HasFactory;
    protected $fillable = [
        'nivel',
    ];

    //relacion uno a muchos inversa
    public function promotor(){
        return $this->hasMany(Promotor::class);
    }

    
}
