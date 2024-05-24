<?php

namespace App\Livewire;

use App\Models\Premio;
use Livewire\Component;
use Livewire\WithPagination;

class Filtropremio extends Component
{
    use WithPagination;

    public $search;
    public $orderBy;

    public function render()
    {
        $premios = Premio::with('producto.imagenes')  
            ->when($this->search, function ($query) {
                $query->whereHas('producto', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->orderBy == 1, function ($query) {
                $query->orderBy('precio_puntos', 'desc');
            })
            ->when($this->orderBy == 2, function ($query) {
                $query->orderBy('precio_puntos', 'asc');
            })
            ->paginate(10);


        return view('livewire.filtropremio', compact('premios'));
    }
}
