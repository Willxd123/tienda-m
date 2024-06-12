<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'precio',
        'producto_id',
        'nota_venta_id'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class);
    }
}
