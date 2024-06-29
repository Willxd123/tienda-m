<?php

namespace App\Livewire\Admin\Orden;

use App\Models\NotaVenta;
use Livewire\Component;

class OrderIndex extends Component
{
    public $ventas;

    public function mount()
    {
        // Cargar todas las ventas con el promotor y orden relacionados
        $this->ventas = NotaVenta::with(['promotor.user', 'orden'])->get();
    }

    public function render()
    {
        return view('livewire.admin.orden.order-index', [
            'ventas' => $this->ventas,
        ]);
    }
}
