<?php

namespace App\Livewire\Cliente\Productos;

use App\Models\Producto;
use Livewire\Component;

class Compra extends Component
{
    public $producto;
    public $cantidad = 1;

    public function compra()
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$this->producto->id])) {
            $cart[$this->producto->id]['cantidad'] += $this->cantidad;
        } else {
            $cart[$this->producto->id] = [
                'id' => $this->producto->id,
                'nombre' => $this->producto->nombre,
                'cantidad' => $this->cantidad,
                'precio' => $this->producto->precio,
                'imagen' => $this->producto->imagen // Asegúrate de que exista esta columna en tu modelo Producto
            ];
        }

        session()->put('cart', $cart);

        $this->emit('ProductoUpdated', count($cart));
        $this->emit('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El producto se ha añadido al carrito'
        ]);
    }

    public function render()
    {
        return view('livewire.cliente.productos.compra');
    }
}
