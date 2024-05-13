<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagenApiController extends Controller
{
    public function imagenes($id)
    {
        $imagenes = Image::where('producto_id', $id)->get();
        return response()->json($imagenes, 200);
    }
}
