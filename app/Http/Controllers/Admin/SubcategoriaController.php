<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategorias = Subcategoria::orderBy('id', 'desc')->with('categoria.familia')->paginate(10);
        return view('admin.subcategorias.index', compact('subcategorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('admin.subcategorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:subcategorias,id',
            'nombre' => 'required',
        ]);

        $subcategoria = Subcategoria::create([
            'subcategoria_id' => $request->subcategoria_id,
            'nombre' => $request->nombre,

        ]);
        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Bien Hecho',
            'text' => 'Familia creada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de una Subcategoría";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Subcategoría";
        $bitacora->registro_id = $subcategoria->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.subcategorias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategoria $subcategoria)
    {
        return view('cliente.subcategorias.show',compact('subcategoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategoria $subcategoria)
    {
        return view('admin.subcategorias.edit', compact('subcategoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategoria $subcategoria, Request $request)
    {
        if($subcategoria->productos()->count()>0){
            session()->flash('swal',[
                'icon' => 'error',
                'title' => '¡ups!',
                'text' => 'no se puede eliminar la subcategoria por que tiene productos asocciadios'
            ]);
            return redirect()->route('admin.subcategorias.edit', $subcategoria);
        }
        $subcategoria->delete();
        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'¡Bien hecho!',
            'text' => 'Subcategoria eliminada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de una Subcategoría";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Subcategoría";
        $bitacora->registro_id = $subcategoria->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.subcategorias.index');
    }
}
