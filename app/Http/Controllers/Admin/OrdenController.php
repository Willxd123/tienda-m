<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\NotaCompra;
use App\Models\NotaVenta;
use App\Models\Orden;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.ordens.index');
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
    public function show(string $id)
    {
        $compras = NotaCompra::findOrFail($id);
        $detalles = DetalleCompra::where('nota_compra_id', $id)->get();
        return view('admin.ordens.ver', compact('compras', 'detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ventaId)
    {
        // Obtener la venta y detalles relacionados
        $venta = NotaVenta::findOrFail($ventaId);
        $detalles = DetalleVenta::where('nota_venta_id', $ventaId)->get();

        // Obtener el estado actual de la orden
        $orden = Orden::where('nota_venta_id', $ventaId)->firstOrFail();

        // Obtener la última entrada de bitácora para esta orden
        $bitacora = Bitacora::where('registro_id', $orden->id)
            ->where('tabla', 'Orden')
            ->orderBy('fecha_hora', 'desc')
            ->first();

        // Devolver la vista de edición con los datos necesarios
        return view('admin.ordens.edit', compact('venta', 'detalles', 'orden', 'bitacora'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'estado' => 'required|boolean',
        ]);

        // Buscar la orden por el ID de la venta
        $orden = Orden::where('nota_venta_id', $id)->firstOrFail();

        // Actualizar el estado de la orden
        $orden->estado = $request->estado;
        $orden->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Puede proceder con la entrega.'
        ]);
        // Crear un nuevo registro en la bitácora
        $bitacora = new Bitacora();
        $bitacora->descripcion = "Orden entregada";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Orden";
        $bitacora->registro_id = $orden->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();
        // Redirigir a alguna vista o acción
        return redirect()->route('admin.ordens.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
