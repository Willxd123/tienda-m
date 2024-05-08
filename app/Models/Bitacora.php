<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'usuario',
        'usuario_id',
        'direccion_ip',
        'navegador',
        'tabla',
        'registro_id',
        'fecha_hora',
    ];

}
