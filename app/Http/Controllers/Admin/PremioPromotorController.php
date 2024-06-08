<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemioPromotor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PremioPromotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $promotor = $user->promotor;        

        if ($promotor){
            $prom = $user->promotor;
            
            $premio_promotors = PemioPromotor::with('premio.producto')
                ->where('promotor_id', $prom->id )
                ->get();
            return view('admin.premio_promotor.index', compact('premio_promotors'));
            
            }else{
            $premio_promotors = PemioPromotor::with('premio.producto')
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.premio_promotor.index', compact('premio_promotors'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //dentro del whith va con el nombre del modelo al que se llama
        $premio_promotor = PemioPromotor::with('premio.producto', 'promotor.user')
            ->findOrFail($id);

        return view('admin.premio_promotor.show', compact('premio_promotor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
