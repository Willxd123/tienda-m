<?php

namespace App\Livewire;


use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Producto;
use App\Models\NotaVenta;
use App\Models\DetalleVenta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShoppingCart extends Component
{
    public function mount()
    {
        Cart::instance('shopping');
    }

    public function increase($rowId)
    {
        Cart::instance('shopping');
        $item = Cart::get($rowId);
        $producto = \App\Models\Producto::find($item->id);
        $totalQty = $item->qty + 1;

        if ($totalQty > $producto->stock) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'No puedes agregar más de la cantidad disponible en stock'
            ]);
            return;
        }

        Cart::update($rowId, $totalQty);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::content()->count());
    }

    public function decrease($rowId)
    {
        Cart::instance('shopping');
        $item = Cart::get($rowId);

        if ($item->qty > 1) {
            Cart::update($rowId, $item->qty - 1);
        } else {
            Cart::remove($rowId);
        }

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::content()->count());
    }

    public function remove($rowId)
    {
        Cart::instance('shopping');
        Cart::remove($rowId);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::content()->count());
    }

    public function destroy()
    {
        Cart::instance('shopping');
        Cart::destroy();

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::content()->count());
    }

    public function compra()
    {
        $productos = Cart::instance('shopping')->content();
        $user = Auth::user();
        $fecha = Carbon::now()->format('d-m-Y');
        $fecha_actual = Carbon::now();
        $fecha_limite = $fecha_actual->addMonths(3)->format('d-m-Y');
        $hora = Carbon::now()->format('H:i:s');

        $filename = 'factura-' . Carbon::now() . '.pdf';
        $aws_ruta = 'https://tienda-m.s3.amazonaws.com/';

        $url = $aws_ruta . $filename;

        $monto = 0;
        foreach ($productos as $producto) {
            $precioOriginal = $producto->price;
            $monto += $producto->qty * $precioOriginal;
        }

        $nota_venta = NotaVenta::create([
            'monto_total' => $monto,
            'fecha' => Carbon::now(),
            'factura' => $url,
        ]);

        foreach ($productos as $producto) {
            $producto_original = Producto::find($producto->id);

            DetalleVenta::create([
                'cantidad' => $producto->qty,
                'precio' => $producto->price,
                'producto_id' => $producto_original->id,
                'nota_venta_id' => $nota_venta->id
            ]);

            $producto_original->update([
                'stock' => ($producto_original->stock - $producto->qty)
            ]);
        }

        Cart::instance('shopping')->destroy();
        $this->dispatch('cartUpdated', Cart::content()->count());
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Compra registrada',
            'text' => 'La Compra se registró correctamente.',
        ]);

        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
