<?php

namespace App\Livewire\Cliente\Productos;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Carrito extends Component
{
    public $producto;
    public $qty = 1; //nombre del variable para sumar o restar cantidad
    public function carrito()
    {
        Cart::instance('shopping');
        Cart::add([
            'id' => $this->producto->id,
            'name' => $this->producto->nombre, // Corregido 'nombre' por 'name'
            'qty' => $this->qty, // Corregido 'cantidad' por 'qty'
            'price' => $this->producto->precio, // Corregido 'precio' por 'price'
            'options' => [
                'image' => $this->producto->imagen
            ]
        ]);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }
        $this->dispatch('cartUpdated', Cart::count()); //evento para el carrito
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
