<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Premio;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $premios = Premio::orderBy('id', 'desc')->paginate(10);
        return view('admin.premios.index', compact('premios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.premios.create');
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
    public function show(Premio $premio)
    {
        $premio->load('producto.imagenes');
        return view('cliente.premios.show', compact('premio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Premio $premio)
    {
        return view('admin.premios.edit', compact('premio'));
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
    public function destroy(Premio $premio, Request $request)
    {
        // Obtener el producto asociado al premio
        $producto = Producto::find($premio->producto_id);

        // Verificar si se encontró el producto
        if ($producto) {
            // Sumar los puntos del premio al producto
            $producto->stock += $premio->stock;
            $producto->save();
        }

        // Guardar información en la bitácora
        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de un Premio";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Premio";
        $bitacora->registro_id = $premio->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        $premio->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El Premio se eliminó correctamente.'
        ]);

        return redirect()->route('admin.premios.index');
    }
}
