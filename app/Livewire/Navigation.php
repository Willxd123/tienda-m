<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Configuracion;
use App\Models\Familia;
use App\Models\Producto;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    public $familias;
    public $colors;
    public $familia_id;
    public $configuracions;
    public $search = '';
    public function mount()
    {
        $this->familias = Familia::all();
        $this->configuracions = Configuracion::all();
        $this->colors = Color::all();
        $this->familia_id = $this->familias->first()->id;;
    }
    public function search($search)
    {
        $this->search = $search;
    }

    #[Computed()]
    public function productos()
    {
        return Producto::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
    #[Computed()]
    public function categorias()
    {
        return Categoria::where('familia_id', $this->familia_id)
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
        return view('livewire.navigation', [
            'productos' => $this->productos(),
        ]);
    }
}
