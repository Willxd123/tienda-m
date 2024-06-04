<?php

namespace App\Livewire\Cliente\Premios;

use App\Http\Controllers\Admin\PremioPromotorController;
use App\Models\Premio;
use App\Models\Promotor;
use App\Models\PremioPromotor;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class Cange extends Component
{

    public $promotor;
    public $premio;
    public $qty = 1; //nombre del variable para sumar o restar cantidad


    public function mount()
    {
        if (auth()->check()) {
            $this->promotor = auth()->user();
        }
    }


    public function cange()
    {
        $promotor = $this->promotor;

        // Verificar si el promotor tiene suficientes puntos para canjear el premio
        if ($promotor->puntos >= $this->premio->precio_puntos * $this->qty) {
            // Descuento de puntos del promotor
            $promotor->decrement('puntos', $this->premio->precio_puntos * $this->qty);

            // Crear registro en la tabla intermedia premio_promotor
            $promotor->premios()->attach($this->premio->id, ['cantidad' => $this->qty]);

            // Actualizar el stock del premio
            $this->premio->decrement('stock', $this->qty);

            // Mostrar mensaje de éxito
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Canje completado',
                'text' => 'El premio ha sido canjeado con éxito.'
            ]);
        } else {
            // Mostrar mensaje de error si el promotor no tiene suficientes puntos
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'No tienes suficientes puntos',
                'text' => 'No tienes suficientes puntos para canjear este premio.'
            ]);
        }
    }


    public function render()
    {
        return view('livewire.cliente.premios.cange');
    }
}