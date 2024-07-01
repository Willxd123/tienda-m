<?php

namespace App\Livewire\Admin\Orden;

use App\Models\Orden;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;
    /*  <a href="{{ route('admin.ordens.edit', ['orden' => $orden->notaVenta->id]) }}" class="btn btn-gray">
                                    Ver Orden
                                </a> */
    public $buscar;
    /* public $ordenes; */

    /* public function mount()
    {
        // Cargar todas las órdenes con la nota de venta y promotor relacionados
        $this->ordenes = Orden::whereHas('notaVenta.promotor.user', function ($query) {
            $query->where('name', 'like', '%' . $this->buscar . '%');
        })->get();
    } */
    public function updatedBuscar()
    {
        $this->resetPage();
    }
    public function updatedFecha()
    {
        $this->resetPage();
    }
    public function render()
    {
        $ordenes = Orden::whereHas('notaVenta.promotor.user', function ($query) {
            $query->where('name', 'like', '%' . $this->buscar . '%');
        })->paginate(10);

        return view('livewire.admin.orden.order-index', [
            'ordenes' => $ordenes,
        ]);
       /*  return view('livewire.admin.orden.order-index', compact('ordenes')); */
    }
}
