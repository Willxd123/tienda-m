<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota_venta_id',
        'estado',
    ];

    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class);
    }
}
