<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemioPromotor extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'fecha',
        'premio_id',
        'promotor_id',
    ];

    //relacion muchos a muchos 
    public function premio(){
        return $this->belongsTo(Premio::class);
    }

    //relacion muchos a muchos
    public function promotor(){
        return $this->belongsTo(Promotor::class);
    }
}
