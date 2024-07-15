<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'monto_total',
        'fecha',
        'factura',
    ];


    public function detalleVentas(){
        return $this->hasMany(DetalleVenta::class);
    }

}
