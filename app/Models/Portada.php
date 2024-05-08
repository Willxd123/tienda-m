<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Portada extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = [
        'imagen',
        'titulo',
        'inicio',
        'fin',
        'activo',
        'orden',
    ];
    protected $casts = [
        'inicio' => 'datetime',
        'fin' => 'datetime',
        'activo' => 'boolean',
    ];
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->imagen),
        );
    }
}
