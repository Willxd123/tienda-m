<?php

namespace App\Http\Controllers;

use App\Models\Portada;
use App\Models\Premio;
use App\Models\Producto;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $premios = Premio::all();
        $portadas = Portada::where('activo', true)
            ->whereDate('inicio','<=',now())
            ->where(function($query){
                $query->whereDate('fin','>=',now())
                ->orWhereNull('fin');
            })
            ->get();
        $productos = Producto::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('productos', 'premios', 'portadas'));
    }
}
