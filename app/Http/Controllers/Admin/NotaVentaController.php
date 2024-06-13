<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\NotaVenta;
use App\Models\PemioPromotor;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaVentaController extends Controller
{

    public function index(){
        $user = Auth::user();
        $promotor = $user->promotor;

        if ($promotor){
            $prom = $user->promotor;
            $ventas = NotaVenta::
                where('promotor_id', $prom->id )
                ->get();
            return view('admin.detalle_ventas.index', compact('ventas'));
        }else{
            $ventas = NotaVenta::orderBy('id', 'desc')
            ->paginate(10);
            return view('admin.detalle_ventas.index', compact('ventas'));
        }

        //$ventas = NotaVenta::orderBy('id', 'desc')->paginate(10);
        //return view('admin.detalle_ventas.index', compact('ventas'));
    }

    /////////////////API/////////////////
    public function store(Request $request, $id)
    {
        $nota_venta = new NotaVenta();
        $monto_total = 0;
        $productos = $request->json()->all();
        foreach ($productos as $prod) {
            $monto_total = $monto_total + ($prod['precio'] * $prod['cantidad']);
        }
        $usuario = User::find($id);
        $nota_venta->monto_total = $monto_total;
        $nota_venta->fecha = Carbon::now();
        $nota_venta->promotor_id = $usuario->promotor->id;
        $nota_venta->save();
        foreach ($productos as $prod) {
            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $prod['cantidad'];
            $detalle_venta->precio = $prod['precio'];
            $detalle_venta->producto_id = $prod['id'];
            $detalle_venta->nota_venta_id = $nota_venta->id;
            $detalle_venta->save();
            
        }

        return response()->json($nota_venta, 200);
    }

    public function show($id)
    {
        $ventas = NotaVenta::findOrFail($id);
        $detalles = DetalleVenta::where('nota_venta_id', $id)->get();
        return view('admin.detalle_ventas.ver', compact('ventas', 'detalles'));
    }
}
