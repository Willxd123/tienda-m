<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rango;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class RangoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rangos = Rango::orderBy('id', 'desc')->paginate(10);
        return view('admin.rangos.index', compact('rangos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rangos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nivel' => 'required|unique:rangos,nivel',
            'descuento' => 'required|numeric',
            'compras_minimas' => 'required|numeric',
        ]);

        $rango = Rango::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Rango creado correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de un Rango";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Rango";
        $bitacora->registro_id = $rango->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.rangos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rango $rango)
    {
        // Obtener los promotores asociados al rango
        $promotores = $rango->promotor()->paginate(10);

        return view('admin.rangos.show', compact('rango', 'promotores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rango $rango)
    {
        return view('admin.rangos.edit', compact('rango'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rango $rango)
    {
        $request->validate([
            'nivel' => ['required', Rule::unique('rangos')->ignore($rango->id)],
            'descuento' => 'required|numeric',
            'compras_minimas' => 'required|numeric',
        ]);

        $rango->update($request->all());

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de un Rango";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Rango";
        $bitacora->registro_id = $rango->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.rangos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rango $rango)
    {
    }

    /**
     * Create bitacora log.
     */
}
