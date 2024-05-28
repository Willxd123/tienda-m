<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use App\Models\Producto;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $premios = Premio::all();
        $productos = Producto::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('productos', 'premios'));
    }
}
