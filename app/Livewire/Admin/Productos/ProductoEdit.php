<?php

namespace App\Livewire\Admin\Productos;

use App\Models\Bitacora;
use App\Models\Categoria;
use App\Models\Familia;
use App\Models\Producto;
use App\Models\Subcategoria;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductoEdit extends Component
{

    use WithFileUploads;
    public $producto;
    public $productoEdit;
    public $familias;
    public $familia_id = '';
    public $categoria_id = '';
    public $subcategoria_id = '';

    public $image;


    public function mount($producto)
    {

        $this->productoEdit = $producto->only('id', 'nombre', 'descripcion', 'stock', 'precio', 'imagen', 'familia_id', 'categoria_id', 'subcategoria_id');
        $this->familias = Familia::all();
        
        $this->categoria_id = $producto->subcategoria->categoria->id;
        $this->familia_id = $producto->subcategoria->categoria->familia_id;
        
    }
    public function updatedProductoFamiliaId()
    {
        $this->categoria_id = '';
        $this->productoEdit['subcategoria_id'] = ''; 
    }

    public function updatedProductoCategoriaId()
    {
        $this->productoEdit['subcategoria_id'] = ''; 
    }


    public function store(Request $request)
    {
        $this->validate([
            /* 'productoEdit.familia_id' => 'required|exists:familias,id',
            'productoEdit.categoria_id' => 'required|exists:categorias,id', */
            'productoEdit.subcategoria_id' => 'required|exists:subcategorias,id',
            'productoEdit.nombre' => 'required|max:255',
            'productoEdit.stock' => 'required|numeric|min:0',
            'productoEdit.descripcion' => 'nullable',
            'productoEdit.precio' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:1024', // Validación para la imagen
        ]);

        // Validar la existencia de familia_id si está presente en el formulario
        if (isset($this->productoEdit['familia_id'])) {
            $rules['productoEdit.familia_id'] = 'required|exists:familias,id';
        }

        // Validar la existencia de categoria_id si está presente en el formulario
        if (isset($this->productoEdit['categoria_id'])) {
            $rules['productoEdit.categoria_id'] = 'required|exists:categorias,id';
        }


        // Actualizar la imagen solo si se proporciona una nueva
        if ($this->image) {
            Storage::delete([$this->productoEdit['imagen']]);
            $this->productoEdit['imagen'] = $this->image->store('productos');
        }

        // Encuentra el producto existente y actualízalo
        $producto = Producto::findOrFail($this->productoEdit['id']);
        $producto->update($this->productoEdit);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Producto actualizado correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de un Producto";
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

    //propiedades computadas
    #[Computed()]
    public function categorias()
    {
        return Categoria::where('familia_id', $this->familia_id)->get();
    }

    #[Computed()]
    public function subcategorias()
    {
        return Subcategoria::where('categoria_id', $this->categoria_id)->get();

    }


    public function render()
    {
        return view('livewire.admin.productos.producto-edit');
    }
}
