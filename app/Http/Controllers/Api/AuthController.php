<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['mensaje' => 'Ha ocurrido un error'],401);
        }
        $user = User::where('email', $request->email)->first();
        $usuario = [];
        $usuario['id'] = $user->id;
        $usuario['name'] = $user->name;
        $usuario['email'] = $user->email;
        $usuario['admin'] = $user->esAdministrador();
        
        return response()->json($usuario, 200);
    }



}
