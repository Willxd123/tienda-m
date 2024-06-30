<?php

namespace App\Livewire\Admin\Orden;

use App\Models\DetalleVenta;
use App\Models\NotaVenta;
use App\Models\Orden;
use Livewire\Component;
use Livewire\WithPagination;

class VerOrden extends Component
{
    use WithPagination;

    public $ordenes;

    public $totalCantidad;
    public $venta;
    public $detalles;
    public $profilePhotoUrl;
    public $promotor;
    public $open = true;
    public function mount($ventaId)
    {
        $this->ordenes = Orden::with(['notaVenta', 'notaVenta.promotor.user'])->get();
        $this->venta = NotaVenta::with(['promotor.user'])->findOrFail($ventaId);
        $this->detalles = DetalleVenta::where('nota_venta_id', $ventaId)->get(); // Asumiendo que tienes una relación 'detalles' en tu modelo NotaVenta
        $this->promotor = $this->venta->promotor;
        $this->totalCantidad = $this->detalles->sum('cantidad');
        $this->profilePhotoUrl = $this->venta->promotor->user->profile_photo_path ?
            'https://laravel-f.s3.amazonaws.com/' . $this->venta->promotor->user->profile_photo_path : null;
    }

    public function verificarOrden()
    {
        // Actualizar el estado de la orden
        $orden = Orden::where('nota_venta_id', $this->venta->id)->first();
        $orden->update(['estado' => true]);

        $this->reset(['open']);
        $this->emit('ordenEstado', ['ordenId' => $orden->id, 'estado' => true]);

        // Cerrar el modal después de verificar
        $this->open = false;

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La orden ha sido verificada y su estado ha sido actualizado.'
        ]);
    }



    public function render()
    {
        return view('livewire.admin.orden.ver-orden', [
            'venta' => $this->venta,
            'detalles' => $this->detalles,
            'profilePhotoUrl' => $this->profilePhotoUrl,
            'promotor' => $this->promotor,
            'totalCantidad' => $this->totalCantidad,
            'ordenes' => $this->ordenes,
        ]);
    }
}
