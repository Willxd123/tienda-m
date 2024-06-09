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
        'promotor_id'
    ];
}
