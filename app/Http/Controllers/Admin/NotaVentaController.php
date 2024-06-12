<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\NotaVenta;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotaVentaController extends Controller
{



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
}