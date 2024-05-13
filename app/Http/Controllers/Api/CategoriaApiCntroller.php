<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaApiCntroller extends Controller
{
    public function show($id){
        $categorias = Categoria::where('familia_id',$id)->get();
        return response()->json($categorias,200);
    }

    public function index(){
        $categorias = Categoria::all();
        return response()->json($categorias,200);
    }
}
