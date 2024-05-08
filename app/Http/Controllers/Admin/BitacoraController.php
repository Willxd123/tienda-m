<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function index(){
        $bitacoras = Bitacora::orderBy('id', 'desc')->paginate(10);
        return view('admin.bitacora.index', compact('bitacoras'));
    }
}
