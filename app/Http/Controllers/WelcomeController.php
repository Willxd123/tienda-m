<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Portada;
use App\Models\Premio;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index()
    {
        $premios = Premio::all();
        $portadas = Portada::where('activo', true)
            ->whereDate('inicio', '<=', now())
            ->where(function ($query) {
                $query->whereDate('fin', '>=', now())
                    ->orWhereNull('fin');
            })
            ->get();
        $productos = Producto::orderBy('created_at', 'desc')->get();
        $catalogo = Catalogo::first(); // Obteniendo el primer catálogo para pasar a la vista

        return view('welcome', compact('productos', 'premios', 'portadas', 'catalogo'));
    }

    /* public function index()
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
    } */
    public function show(Catalogo $catalogo)
    {
        return $this->viewPdf($catalogo->catalogo);
    }
    private function viewPdf($url)
    {
        // Aumentar el tiempo de ejecución máximo
        ini_set('max_execution_time', 300);

        // Extraer el path relativo del URL
        $path = str_replace('https://tienda-m.s3.amazonaws.com/', '', $url);

        // Obtener el contenido del archivo desde S3
        $content = Storage::disk('s3')->get($path);

        // Obtener el nombre del archivo
        $filename = basename($path);

        // Mostrar el archivo en el navegador
        return response($content)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "inline; filename=\"{$filename}\"");
    }
}
