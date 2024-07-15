<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\NotaVenta;
use App\Models\Producto;
use App\Models\Rango;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('welcome');
    }

    public function session(Request $request)
    {

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productos = Cart::instance('shopping')->content();



        $items = [];
        $user = Auth::user();

        foreach ($productos as $producto) {

            $producto_original = Producto::where('nombre', $producto->name)->first();
            if ($producto->qty > $producto_original->stock) {
                return redirect()->back()->with(session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'Stock insuficiente para el producto ' . $producto->name
                ]));
            }
            $productName = $producto->name;


            $precioOriginal = $producto->price;
            $precioConDescuento = $precioOriginal;


            if ($user && $user->promotor) {
                $promotor = $user->promotor;
                $rango = $promotor->rango;
                $descuento = $rango->descuento;
                $precioConDescuento = $precioOriginal - $precioOriginal * ($descuento / 100);
            }

            $totalprice = $precioConDescuento;
            //$totalprice = $producto->price;

            $unitAmount = $totalprice * 100;
            $quantity = $producto->qty;

            $items[] = [
                'price_data' => [
                    'currency'     => 'BOB',
                    'product_data' => [
                        "name" => $productName,
                    ],
                    'unit_amount'  => $unitAmount,
                ],
                'quantity'   => $quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => $items,
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        $productos = Cart::instance('shopping')->content();
        $user = Auth::user();
        $promotor = $user->promotor;
        $fecha = Carbon::now()->format('d-m-Y');
        $fecha_actual = Carbon::now();
        $fecha_limite = $fecha_actual->addMonths(3)->format('d-m-Y');
        $hora = Carbon::now()->format('H:i:s');

        $pdf = Pdf::loadView('pdf.factura', [
            'productos' => $productos,
            'user' => $user,
            'promotor' => $promotor,
            'fecha' => $fecha,
            'hora' => $hora,
            'fecha_limite' => $fecha_limite
        ]);

        $pdf_archivo = $pdf->output();
        $filename = 'factura-' . Carbon::now() . '.pdf';
        $aws_ruta = 'https://tienda-m.s3.amazonaws.com/';
        Storage::disk('s3')->put($filename, $pdf_archivo, 'public');
        $url = $aws_ruta . $filename;

        $promotor = Auth::user()->promotor;
        $puntos = $promotor->puntos;
        $monto = 0;
        foreach ($productos as $producto) {

            $precioOriginal = $producto->price;
            $precioConDescuento = $precioOriginal;

            if ($user && $user->promotor) {
                $promotor = $user->promotor;
                $rango = $promotor->rango;
                $descuento = $rango->descuento;
                $precioConDescuento = $precioOriginal - ($precioOriginal * ($descuento / 100));
            }

            $monto = $monto + ($producto->qty * $precioConDescuento);
            //$monto = $monto + ($producto->qty * $producto->price);

        }
        $nota_venta = NotaVenta::create([
            'monto_total' => $monto,
            'fecha' => Carbon::now(),
            'factura' => $url,
            'promotor_id' => $promotor->id
        ]);
        $orden = $nota_venta->orden()->create([
            'estado' => false // Estado inicial pendiente
        ]);

        foreach ($productos as $producto) {
            $producto_original = Producto::where('nombre', $producto->name)->first();
            $precioOriginal = $producto->price;
            $precioConDescuento = $precioOriginal;

            if ($user && $user->promotor) {
                $promotor = $user->promotor;
                $rango = $promotor->rango;
                $descuento = $rango->descuento;
                $precioConDescuento = $precioOriginal - ($precioOriginal * ($descuento / 100));
            }

            DetalleVenta::create([
                'cantidad' => $producto->qty,
                'precio' => $precioConDescuento,
                'producto_id' => $producto_original->id,
                'nota_venta_id' => $nota_venta->id
            ]);

            $puntos = $puntos + ($producto_original->puntos * $producto->qty);

            $producto_original->update([
                'stock' => ($producto_original->stock - $producto->qty)
            ]);
        }

        $promotor->update([
            'puntos' => $puntos,
        ]);

        // Calcular el total de compras del promotor
        $totalCompras = NotaVenta::where('promotor_id', $promotor->id)->sum('monto_total');

        // Obtener todos los rangos ordenados por compras_minimas
        $rangos = Rango::orderBy('compras_minimas')->get();

        // Verificar si el promotor califica para un nuevo rango
        $nuevoRango = $promotor->rango_id;
        foreach ($rangos as $rango) {
            if ($totalCompras >= $rango->compras_minimas) {
                $nuevoRango = $rango->id;
            }
        }

        // Actualizar el rango del promotor si es necesario
        if ($nuevoRango != $promotor->rango_id) {
            $promotor->rango_id = $nuevoRango;
            $promotor->save();

            // Obtener el nuevo nivel del rango
            $nivelRango = Rango::find($nuevoRango)->nivel;

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Felicidades!',
                'text' => 'Has avanzado al ' . $nivelRango,
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Compra registrada',
                'text' => 'La Compra se registró correctamente.',
            ]);
        }

        Cart::instance('shopping')->destroy();
        return redirect()->back();
    }

    public function redireccionar()
    {
        return view('welcome');
    }

    public function prueba()
    {
        $pdf = Pdf::loadView('pdf.factura');
        return $pdf->download('factura-' . Carbon::now() . '.pdf');
    }
}
