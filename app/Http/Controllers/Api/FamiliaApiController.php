<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliaApiController extends Controller
{
    public function index(){
        $familias = Familia::all();
        return response()->json($familias,200);
    }
}
