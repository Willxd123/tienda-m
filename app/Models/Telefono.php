<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'proveedor_id',
    ];

    //relacion uno a muchos inversa
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

}
