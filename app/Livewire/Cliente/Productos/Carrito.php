<?php

namespace App\Livewire\Cliente\Productos;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Carrito extends Component
{
    public $producto;
    public $qty = 1; // Nombre de la variable para sumar o restar cantidad

    public function mount($producto)
    {
        $this->producto = $producto;
    }

    public function carrito()
    {
        Cart::instance('shopping');
        $existingItem = Cart::content()->firstWhere('id', $this->producto->id);
        $totalQty = $this->qty + ($existingItem ? $existingItem->qty : 0);

        if ($totalQty > $this->producto->stock) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'La cantidad total seleccionada excede el stock disponible'
            ]);
            return;
        }

        Cart::add([
            'id' => $this->producto->id,
            'name' => $this->producto->nombre,
            'qty' => $this->qty,
            'price' => $this->producto->precio,
            'options' => [
                'image' => $this->producto->imagen
            ]
        ]);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::content()->count());
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El producto se ha añadido al carrito'
        ]);
    }

    public function render()
    {
        return view('livewire.cliente.productos.carrito');
    }
}
