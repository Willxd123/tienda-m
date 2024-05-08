<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'precio',
        'nota_compra_id',
        'producto_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function notaCompra()
    {
        return $this->belongsTo(NotaCompra::class);
    }
}
