<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\Familia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'desc')->paginate(10);
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $familias = Familia::all();
        return view('admin.categorias.create', compact('familias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'familia_id' => 'required|exists:familias,id',
            'nombre' => 'required',
        ]);

        $categoria = Categoria::create([
            'familia_id' => $request->familia_id,
            'nombre' => $request->nombre,
        ]);
        
        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creacion de una Categoría";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Categoría";
        $bitacora->registro_id = $categoria->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.categorias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('cliente.categorias.show',compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        $familias = Familia::all();
        return view('admin.categorias.edit', compact('categoria', 'familias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'familia_id' => 'required|exists:familias,id',
            'nombre' => 'required',
        ]);
        $categoria->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Categoria actualizada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de una Categoría";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Categoría";
        $bitacora->registro_id = $categoria->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.categorias.index', $categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria, Request $request)
    {
        if ($categoria->subcategorias->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se puede eliminar la familia porque tiene categorias asociadas.'
            ]);
            return redirect()->route('admin.categorias.edit', $categoria);
        }
        $categoria->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Familia eliminada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de una Categoría";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Categoría";
        $bitacora->registro_id = $categoria->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.categorias.index');
    }
}
