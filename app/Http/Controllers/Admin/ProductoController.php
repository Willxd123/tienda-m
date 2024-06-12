<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Familia;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Subcategoria;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::orderBy('id', 'desc')->with('subcategoria.categoria.familia')->paginate(10);
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * ->with('subcategoria.categoria.familia')
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.productos.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        
        return view('cliente.productos.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)

    {
        return view('admin.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Excelente!',
            'text' => 'El usuario fue eliminado.'
        ]);

        return redirect()->route('admin.productos.index' );
    }

    public function pdfFactura(Request $request, $id){
        $productos = $request->json()->all();
        $user = User::find($id);
        $promotor = $user->promotor;
        $fecha = Carbon::now()->format('d-m-Y');
        $fecha_actual = Carbon::now();
        $fecha_limite = $fecha_actual->addMonths(3)->format('d-m-Y');
        $hora = Carbon::now()->format('H:i:s');
        $pdf = Pdf::loadView('pdf.factura_movil', [
            'productos' => $productos,
            'user' => $user,
            'promotor' => $promotor,
            'fecha' => $fecha,
            'hora' => $hora,
            'fecha_limite' => $fecha_limite
        ]); 
        return Pdf::download($pdf, Carbon::now().'.pdf');
    }
}
