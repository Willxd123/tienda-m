<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Filtro extends Component
{
    use WithPagination;
    public $subcategoria_id;
    public $categoria_id;
    public $familia_id;
    public $orderBy = 1;
    public $search;

    public function render()
    {
        $productos = Producto::when($this->familia_id, function ($query) {
            $query->whereHas('subcategoria.categoria', function ($query) {
                $query->where('familia_id', $this->familia_id);
            });
        })
        ->when($this->categoria_id, function($query){
            $query->whereHas('subcategoria', function($query){
                $query->where('categoria_id', $this->categoria_id);
            });
        })
        ->when($this->subcategoria_id, function($query){
            $query->where('subcategoria_id', $this->subcategoria_id);
        })
        ->when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        })
        ->when($this->orderBy == 1, function ($query) {
            $query->orderBy('precio', 'desc');
        })
        ->when($this->orderBy == 2, function ($query) {
            $query->orderBy('precio', 'asc');
        })
        ->paginate(10);

        return view('livewire.filtro', compact('productos'));
    }
}
