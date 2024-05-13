<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubCategoriaApiController extends Controller
{
    public function index($id){
        $subcategorias = Subcategoria::where('categoria_id', $id)->get();
        return response()->json($subcategorias,200);
    }
}
