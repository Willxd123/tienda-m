<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Configuracion extends Model
{
    use HasFactory;
    protected $fillable = [
        'logotipo',
    ];
    //relacion muchos a muchos
    public function colors():BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'configuracion_color');
    }
}
