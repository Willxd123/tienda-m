<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Producto;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create($id)
    {
        $producto = Producto::find($id);
        return view('admin.imagenes.create', compact('producto'));
    }

    public function store(Request $request, $id)
    {
        $producto = Producto::find($id);
        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';

        $image_ruta = $request->file('ruta1')->storePublicly('productos');
        $image_url = $aws_ruta . $image_ruta;
        $producto->imagen = $image_url;
        Image::create(['ruta' => $image_url, 'producto_id' => $producto->id]);

        $image_ruta = $request->file('ruta2')->storePublicly('productos');
        $image_url = $aws_ruta . $image_ruta;
        Image::create(['ruta' => $image_url, 'producto_id' => $producto->id]);

        $image_ruta = $request->file('ruta3')->storePublicly('productos');
        $image_url = $aws_ruta . $image_ruta;
        Image::create(['ruta' => $image_url, 'producto_id' => $producto->id]);

        $image_ruta = $request->file('ruta4')->storePublicly('productos');
        $image_url = $aws_ruta . $image_ruta;
        Image::create(['ruta' => $image_url, 'producto_id' => $producto->id]);

        $producto->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Imágenes agregadas correctamente.'
        ]);

        return redirect()->route('admin.productos.index');
    }
}
