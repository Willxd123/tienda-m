<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotor;
use App\Models\User;
use Illuminate\Http\Request;

class PromotorApiController extends Controller
{
    public function actualizarPuntos($id, Request $request){
        $user = User::find($id);
        $promotor = $user->promotor;
        $puntos = $promotor->puntos + $request->puntos;
        $promotor->update([
            'puntos' => $puntos 
        ]);

        return response()->json([
            'puntos' => $puntos
        ], 200);
    }

    public function promotor($id){
        $user = User::find($id);
        $prom = $user->promotor;
        $promotor = [];
        $promotor['id'] = $prom->id;
        $promotor['puntos'] = $prom->puntos;
        return response()->json($promotor, 200);
    }
}
