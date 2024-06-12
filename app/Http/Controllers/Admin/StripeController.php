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
use Illuminate\Support\Facades\Log;

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
        // $pdf = Pdf::loadView('pdf.factura');
        // $productos = Cart::instance('shopping')->content();
        // $nota_venta = NotaVenta::create([
        //     'monto_total'=>Cart::instance('shopping')->subTotal(),
        //     'fecha'=>Carbon::now(),
        //     'promotor_id' => Auth::user()->promotor->id
        // ]);
        // foreach ($productos as $producto) {
        //     $producto_original = Producto::where('nombre', $producto->name)->first();
        //     DetalleVenta::create([
        //         'cantidad' => $producto->qty,
        //         'precio' => $producto->price,
        //         'producto_id' => $producto_original->id,
        //         'nota_venta_id' => $nota_venta->id
        //     ]);
        //     $producto_original->update([
        //         'stock' => ($producto_original->stock - $producto->qty)
        //     ]);
        // }
        // Cart::instance('shopping')->destroy();
        // return $pdf->download('factura-' . Carbon::now() . '.pdf');
        try {
            // Renderiza la vista del PDF
            $pdf = Pdf::loadView('pdf.factura');
            
            // Obtiene los productos del carrito
            $productos = Cart::instance('shopping')->content();
            
            // Crea una nueva nota de venta
            $nota_venta = NotaVenta::create([
                'monto_total' => Cart::instance('shopping')->subTotal(),
                'fecha' => Carbon::now(),
                'promotor_id' => Auth::user()->promotor->id
            ]);
            
            // Itera sobre los productos del carrito
            foreach ($productos as $producto) {
                $producto_original = Producto::where('nombre', $producto->name)->first();
                
                // Crea un nuevo detalle de venta
                DetalleVenta::create([
                    'cantidad' => $producto->qty,
                    'precio' => $producto->price,
                    'producto_id' => $producto_original->id,
                    'nota_venta_id' => $nota_venta->id
                ]);
                
                // Actualiza el stock del producto
                $producto_original->update([
                    'stock' => ($producto_original->stock - $producto->qty)
                ]);
            }
            
            // Limpia el carrito
            Cart::instance('shopping')->destroy();
            
            // Descarga el PDF
            return $pdf->download('factura.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->route('fallback.route')->with('error', 'Error generating PDF. Please try again later.');
        }
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
