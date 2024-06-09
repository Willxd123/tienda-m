<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
