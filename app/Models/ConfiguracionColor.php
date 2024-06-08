<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ConfiguracionColor extends Model
{
    protected $table = 'configuracion_color';
    
    // Si tu clave primaria no es 'id', debes especificarlo aquí
    // protected $primaryKey = 'nombre_de_tu_clave_primaria';

    // Si tus columnas de timestamp tienen nombres diferentes
    // protected $timestamps = true;
    // protected $createdAt = 'nombre_de_tu_columna_created_at';
    // protected $updatedAt = 'nombre_de_tu_columna_updated_at';
}
