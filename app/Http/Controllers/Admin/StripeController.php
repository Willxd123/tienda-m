<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\NotaVenta;
use App\Models\Producto;
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

        foreach ($productos as $producto) {

            $producto_original = Producto::where('nombre', $producto->name)->first();
            if ($producto->qty > $producto_original->stock) {
                // return session()->flash('swal', [
                //     'icon' => 'error',
                //     'title' => '¡Ups!',
                //     'text' => 'Stock insuficiente para el producto '. $producto->name
                // ]);
                return redirect()->back()->with(session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'Stock insuficiente para el producto ' . $producto->name
                ]));
            }
            $productName = $producto->name;
            $totalprice = $producto->price;
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
        $pdf = Pdf::loadView('pdf.factura');
        $pdf_archivo = $pdf->output();
        $filename = 'factura-'.Carbon::now() . '.pdf';
        $aws_ruta = 'https://laravel-f.s3.amazonaws.com/';
        Storage::disk('s3')->put($filename, $pdf_archivo, 'public');
        $url = $aws_ruta.$filename;


        $productos = Cart::instance('shopping')->content();
        $promotor = Auth::user()->promotor;
        $puntos = $promotor->puntos;
        $nota_venta = NotaVenta::create([
            'monto_total'=>Cart::instance('shopping')->subTotal(),
            'fecha'=>Carbon::now(),
            'factura'=>$url,
            'promotor_id' => $promotor->id
        ]);
        foreach ($productos as $producto) {
            $producto_original = Producto::where('nombre', $producto->name)->first();
            DetalleVenta::create([
                'cantidad' => $producto->qty,
                'precio' => $producto->price,
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
