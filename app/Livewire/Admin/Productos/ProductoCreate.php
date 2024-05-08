<?php

namespace App\Livewire\Admin\Productos;

use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\Familia;
use App\Models\Producto;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

use Livewire\Attributes\Validate;

class ProductoCreate extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')]

    public $image = "";
    public $familias;
    public $familia_id = '';
    public $categoria_id = '';
    public $subcategoria_id = '';

    public $producto = [
        'familia_id' => '',
        'categoria_id' => '',
        'subcategoria_id' => '',
        'nombre' => '',
        'stock' => '',
        'descripcion' => '',
        'precio' => '',
        'imagen' => '',
    ];


    public function mount()
    {
        $this->familias = Familia::all();
    }
    public function updatedProductoFamiliaId()
    {
        $this->categoria_id = '';
        $this->producto['subcategoria_id']= ''; // Cambiado a subcategoria_id en lugar de producto['subcategoria_id']
    }

    public function updatedProductoCategoriaId()
    {
        $this->producto['subcategoria_id'] = ''; // Cambiado a subcategoria_id en lugar de producto['subcategoria_id']
    }


    public function store(Request $request)
    {
        $this->validate([
            'producto.subcategoria_id' => 'required|exists:subcategorias,id',
            'producto.categoria_id' => 'required|exists:categorias,id',
            'producto.familia_id' => 'required|exists:familias,id',
            'producto.nombre' => 'required|max:255',
            'producto.stock' => 'required|numeric|min:0',
            'producto.descripcion' => 'nullable',
            'producto.precio' => 'required|numeric|min:0',
        ], [], [
            'producto.subcategoria_id' => 'subcategoria',
            'producto.categoria_id' => 'categoria',
            'producto.familia_id' => 'familia',
            'producto.nombre' => 'nombre',
            'producto.stock' => 'stock',
            'producto.descripcion' => 'descripcion',
            'producto.precio' => 'precio',
        ]);
        $this->producto['imagen']= $this->image;
        $producto = Producto::create($this->producto);
        
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Producto creado correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de un Producto";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Producto";
        $bitacora->registro_id = $producto->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.productos.index');
    }


    #[Computed()]
    public function categorias()
    {
        if ($this->producto['familia_id']) {
            return Categoria::where('familia_id', $this->producto['familia_id'])->get();
        } else {
            return collect(); // Retorna una colección vacía si no se ha seleccionado una familia
        }
    }

    #[Computed()]
    public function subcategorias()
    {
        if ($this->producto['categoria_id']) {
            return Subcategoria::where('categoria_id', $this->producto['categoria_id'])->get();
        } else {
            return collect(); // Retorna una colección vacía si no se ha seleccionado una categoría
        }
    }

    public function render()
    {
        return view('livewire.admin.productos.producto-create');
    }
}
