<?php

namespace App\Livewire;

use App\Models\Color;
use App\Models\Configuracion;
use Livewire\Component;

class Footer extends Component
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
        return view('livewire.footer');
    }
}
