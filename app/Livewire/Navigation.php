<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Familia;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    public $familias;
    public $familia_id;

    public function mount()
    {
        $this->familias = Familia::all();
        $this->familia_id = $this->familias->first()->id;  ;
    }

    #[Computed()]
    public function categorias()
    {
        return Categoria::where('familia_id',$this->familia_id)
        ->with('subcategorias')
        ->get();
    }
    #[Computed()]
    public function familiaNombre()
    {
        return Familia::find($this->familia_id)->nombre;
    }
    public function render()
    {
        return view('livewire.navigation');
    }
}
