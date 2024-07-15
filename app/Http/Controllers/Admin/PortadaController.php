<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Portada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PortadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $request->validate([
            'imagen' => 'required|image|max:1024',
            'titulo' => 'required|string|max:250',
            'inicio' => 'required|date|after_or_equal:today',
            'fin' => 'nullable|date|after_or_equal:inicio',
            'activo' => 'required|boolean'
        ], [
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no debe superar los 1024KB.',
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no debe tener más de 250 caracteres.',
            'inicio.required' => 'La fecha de inicio es obligatoria.',
            'inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'inicio.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',
            'fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'activo.required' => 'El campo activo es obligatorio.',
            'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
        ]);

        $aws_ruta = 'https://tienda-m.s3.amazonaws.com/';
        $image_url = null;

        // Almacenar la imagen
        if ($request->hasFile('imagen')) {
            $image_ruta = $request->file('imagen')->storePublicly('portadas');
            $image_url = $aws_ruta . $image_ruta;
        }

        // Obtener el valor máximo actual de "orden" y sumarle 1
        $maxOrden = Portada::max('orden');
        $newOrden = $maxOrden ? $maxOrden + 1 : 1;

        // Crear el registro en la base de datos
        $portada = Portada::create([
            'imagen' => $image_url,
            'titulo' => $request->titulo,
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'activo' => $request->activo,
            'orden' => $newOrden
        ]);

        // Crear registro en bitacora
        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de una portada";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Portada";
        $bitacora->registro_id = $portada->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

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
        $request->validate([
            'imagen' => 'nullable|image|max:5024',
            'titulo' => 'required|string|max:250',
            'inicio' => 'required|date|after_or_equal:today',
            'fin' => 'nullable|date|after_or_equal:inicio',
            'activo' => 'required|boolean'
        ], [
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no debe superar los 5Mb.',
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no debe tener más de 250 caracteres.',
            'inicio.required' => 'La fecha de inicio es obligatoria.',
            'inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'inicio.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',
            'fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'activo.required' => 'El campo activo es obligatorio.',
            'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
        ]);

        $aws_ruta = 'https://tienda-m.s3.amazonaws.com/';
        $image_url = $portada->imagen;

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior del almacenamiento
            if ($portada->imagen) {
                $oldImagePath = str_replace($aws_ruta, '', $portada->imagen);
                Storage::delete($oldImagePath);
            }

            // Almacenar la nueva imagen
            $image_ruta = $request->file('imagen')->storePublicly('portadas');
            $image_url = $aws_ruta . $image_ruta;
        }

        // Actualizar los campos en la base de datos
        $portada->update([
            'imagen' => $image_url,
            'titulo' => $request->titulo,
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'activo' => $request->activo
        ]);

        // Crear registro en bitacora
        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de una portada";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Portada";
        $bitacora->registro_id = $portada->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Portada actualizada correctamente.'
        ]);

        return redirect()->route('admin.portadas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portada $portada, Request $request)
    {
        if ($portada->imagen) {
            $aws_ruta = 'https://tienda-m.s3.amazonaws.com/';
            $oldImagePath = str_replace($aws_ruta, '', $portada->imagen);
            Storage::delete($oldImagePath);
        }

        $portada->delete();

        // Crear registro en bitacora
        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de una portada";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Portada";
        $bitacora->registro_id = $portada->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Excelente!',
            'text' => 'La portada fue eliminada con éxito.'
        ]);

        return redirect()->route('admin.portadas.index');
    }
}
