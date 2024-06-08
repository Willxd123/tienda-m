<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Configuracion;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $configuracionss = Configuracion::with('colors')->get();
        $colors = Color::all();
        return view('footer.index', compact('configuracionss', 'colors'));
    }
}


