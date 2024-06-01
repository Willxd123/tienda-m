<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //migrasion = modulo (identifica al modulo y la bd para la funcionalidad)
        $portadas = Portada::orderBy('id', 'desc')->paginate(10);
        return view('admin.portadas.index', compact('portadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portadas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
/*
        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';
        $image_ruta = $request->file('image');
        $image_url = $aws_ruta . $image_ruta;
        $imagen = $image_url; */

        $request->validate([
            'imagen' => 'required|image|max:1024',
            'titulo' => 'required|string|max:250',
            'inicio' => 'required|date',
            'fin' => 'nullable|date|after_or_equal:inicio',
            'activo' => 'required|boolean'
        ]);
        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';
        // Almacenar la imagen
        if ($request->hasFile('imagen')) {
            $image_ruta = $request->file('imagen')->storePublicly('portadas', 'public');
            $image_url = $aws_ruta . $image_ruta;
        }
        // Obtener el valor máximo actual de "orden" y sumarle 1
        $maxOrden = Portada::max('orden');
        $newOrden = $maxOrden ? $maxOrden + 1 : 1;
        // Crear el registro en la base de datos
        Portada::create([
            'imagen' => $image_url,
            'titulo' => $request->titulo,
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'activo' => $request->activo,
            'orden' => $newOrden// Asignar el valor de orden si está presente
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Portada agregada correctamente.'
        ]);

        return redirect()->route('admin.portadas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portada $portada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portada $portada)
    {
        return view('admin.portadas.edit', compact('portada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portada $portada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portada $portada)
    {
        //
    }
}
