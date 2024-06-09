<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class CatalogoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogos = Catalogo::all();

        return view('admin.catalogos.index', compact('catalogos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catalogos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'catalogo' => 'required|file|mimes:pdf|max:51200', // Validación para PDF de hasta 50MB
        ]);

        // Almacenar el PDF en S3
        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';
        $pdfPath = null;
        if ($request->hasFile('catalogo')) {
            $pdfPath = $request->file('catalogo')->store('catalogos', 's3');
            $pdfUrl = $aws_ruta . $pdfPath;
        }

        // Crear el registro en la base de datos
        Catalogo::create([
            'nombre' => $request->input('nombre'),
            'catalogo' => $pdfUrl,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Catálogo agregado correctamente.'
        ]);

        return redirect()->route('admin.catalogos.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(catalogo $catalogo)
    {
        return $this->viewPdf($catalogo->catalogo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(catalogo $catalogo)
    {
        return view('admin.catalogos.edit', compact('catalogo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalogo $catalogo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'catalogo' => 'nullable|file|mimes:pdf|max:51200', // Validación para PDF de hasta 50MB
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe tener más de 255 caracteres.',
            'catalogo.required' => 'El archivo de catálogo es obligatorio.',
            'catalogo.file' => 'El archivo de catálogo debe ser un archivo.',
            'catalogo.mimes' => 'El archivo de catálogo debe ser un archivo PDF.',
            'catalogo.max' => 'El archivo de catálogo no debe superar los 50MB.',
        ]);

        // Almacenar el nuevo PDF en S3, si se proporciona
        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';
        if ($request->hasFile('catalogo')) {
            // Eliminar el PDF anterior de S3 si existe
            if ($catalogo->catalogo) {
                $oldPdfPath = str_replace($aws_ruta, '', $catalogo->catalogo);
                Storage::disk('s3')->delete($oldPdfPath);
            }

            // Subir el nuevo PDF
            $pdfPath = $request->file('catalogo')->store('catalogos', 's3');
            $catalogo->catalogo = $aws_ruta . $pdfPath;
        }

        // Actualizar los datos del catálogo
        $catalogo->nombre = $request->input('nombre');
        $catalogo->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Catálogo actualizado correctamente.'
        ]);

        return redirect()->route('admin.catalogos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(catalogo $catalogo)
    {
        //
    }

    private function viewPdf($url)
    {
        // Aumentar el tiempo de ejecución máximo
        ini_set('max_execution_time', 300);

        // Extraer el path relativo del URL
        $path = str_replace('https://laravel-f.s3.amazonaws.com/', '', $url);

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
