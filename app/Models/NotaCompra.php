<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCompra extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'monto_total' ,
        'proveedor_id',
    ];

    //relacion muchos a muchos 
    public function productos(){
        return $this->belongsToMany(Producto::class, 'detalle_compras');
    }

    //relacion uno a muchos inversa
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
}
