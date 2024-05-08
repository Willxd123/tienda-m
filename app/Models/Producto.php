<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = [
        'nombre',
        'stock' ,
        'descripcion' ,
        'precio',
        'imagen',
        'subcategoria_id',
    ];
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->imagen),
        );
    }

    public function imagenes(){
        return $this->hasMany(Image::class);
    }

    //relacion uno a muchos inversa
    public function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }


    //relacion uno a muchos
    public function variantes(){
        return $this->hasMany(Variante::class);
    }

    //relacion muchos a muchos 
    public function opcions(){
        return $this->belongsToMany(Opcion::class)
                    ->withPivot('valor')
                    ->withTimestamps();
    }

    //relacion muchos a muchos 
    public function nota_compras(){
        return $this->belongsToMany(Proveedor::class)
                    ->withTimestamps();
    }
    
}
