<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'color',
    ];
    //relacion muchos a muchos
    public function configuracions():BelongsToMany
    {
        return $this->belongsToMany(configuracion::class,'configuracion_color');

    }
}
