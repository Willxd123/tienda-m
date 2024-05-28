<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout(){
        return view('welcome');
    }

    public function session(Request $request){

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productos = Cart::instance('shopping')->content();

        $items = [];

        foreach ($productos as $producto) {
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
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }

    public function prueba(){
        $pdf = Pdf::loadView('pdf.factura');
        return $pdf->download('factura-'.Carbon::now().'.pdf');
    }

}
