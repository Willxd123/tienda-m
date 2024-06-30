<?php

namespace App\Livewire\Admin\Orden;

use App\Models\Orden;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public $ordenes;

    public function mount()
    {
        // Cargar todas las órdenes con la nota de venta y promotor relacionados
        $this->ordenes = Orden::with(['notaVenta', 'notaVenta.promotor.user'])->get();
    }

    public function render()
    {
        return view('livewire.admin.orden.order-index', [
            'ordenes' => $this->ordenes,
        ]);
    }
}
