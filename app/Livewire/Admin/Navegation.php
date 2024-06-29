<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use App\Models\Configuracion;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Navegation extends Component
{
    public $colors;
    public $configuracions;

    public function mount()
    {

        $this->configuracions = Configuracion::all();
        $this->colors = Color::all();
    }
    public function render()
    {
        return view('livewire.admin.navegation');
    }
}
