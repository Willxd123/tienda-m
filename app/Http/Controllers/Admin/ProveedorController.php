<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Proveedor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::orderBy('id', 'desc')->paginate(10);
        return view('admin.proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'correo' => 'required',
            'encargado' => 'required',
        ]);

        $proveedor = Proveedor::create($request->all());

        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Bien Hecho',
            'text' => 'Proveedor creada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de un Proveedor";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Proveedor";
        $bitacora->registro_id = $proveedor->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.proveedors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('admin.proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'correo' => 'required',
            'encargado' => 'required',
        ]);
        $proveedor->update($request->all());
        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Bien Hecho',
            'text' => 'El proveedor actualizada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de un Proveedor";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Proveedor";
        $bitacora->registro_id = $proveedor->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.proveedors.index', $proveedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor, Request $request)
    {
        $proveedor->delete();

        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'¡Bien hecho!',
            'text' => 'El proveedor eliminada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de un Proveedor";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Proveedor";
        $bitacora->registro_id = $proveedor->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.proveedors.index');
    }
}
