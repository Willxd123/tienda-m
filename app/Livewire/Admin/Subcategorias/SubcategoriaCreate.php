<?php

namespace App\Livewire\Admin\Subcategorias;

use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\Familia;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoriaCreate extends Component
{
    public $familias;
    public $subcategoria = [
        'familia_id' => '',
        'categoria_id' => '',
        'nombre' => '',
    ];


    public function mount()
    {
        $this->familias = Familia::all();
    }
    public function updatedSubcategoriaFamiliaId()
    {
        $this->subcategoria['categoria_id'] = '';
    }
    public function save(Request $request)
    {
        $this->validate([
            'subcategoria.categoria_id' => 'required|exists:categorias,id',
            'subcategoria.familia_id' => 'required|exists:familias,id',
            'subcategoria.nombre' => 'required',
        ], [], [
            'subcategoria.categoria_id' => 'categoria',
            'subcategoria.familia_id' => 'familia',
            'subcategoria.nombre' => 'nombre',
        ]);
        $subcategoria = Subcategoria::create($this->subcategoria);
        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Bien Hecho',
            'text' => 'Subcategoria creada correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de una Subcategoría";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Subcategoría";
        $bitacora->registro_id = $subcategoria->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.subcategorias.index');
    }

    #[Computed()]
    public function categorias()
    {
        if ($this->subcategoria['familia_id']) {
            return Categoria::where('familia_id', $this->subcategoria['familia_id'])->get();
        } else {
            return collect(); // Retorna una colección vacía si no se ha seleccionado una familia
        }
    }
    public function render()
    {
        return view('livewire.admin.subcategorias.subcategoria-create');
    }
}
