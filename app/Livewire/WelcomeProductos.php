<?php

namespace App\Livewire;

use App\Models\Catalogo;
use App\Models\Portada;
use App\Models\Premio;
use App\Models\Producto;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class WelcomeProductos extends Component
{
    use WithPagination;

    public $search;

    #[On('search')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $productos = Producto::where('nombre', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.welcome-productos', [
            'productos' => $productos,
        ]);
    }
}
