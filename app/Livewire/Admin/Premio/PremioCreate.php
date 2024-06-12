<?php

namespace App\Livewire\Admin\Premio;

use App\Models\Bitacora;
use App\Models\Premio;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

use Livewire\Attributes\Validate;
use Livewire\Component;

class PremioCreate extends Component
{

    use WithFileUploads;

    public $productos; //del selec

    public $premio = [
        'stock' => '',
        'precio_puntos' => '',
        'producto_id' => '',
    ];

    public function mount()
    {
        $this->productos = Producto::all();
    }

    public function store(Request $request)
    {
        $this->validate([
            'premio.stock' => 'required|numeric|min:0',
            'premio.precio_puntos' => 'required|numeric|min:0',
            'premio.producto_id' => 'required|exists:productos,id|unique:premios,producto_id',
        ], [
            'premio.stock.required' => 'El stock es obligatorio.',
            'premio.stock.numeric' => 'El stock debe ser un número.',
            'premio.stock.min' => 'El stock debe ser al menos 0.',
            'premio.precio_puntos.required' => 'El precio en puntos es obligatorio.',
            'premio.precio_puntos.numeric' => 'El precio en puntos debe ser un número.',
            'premio.precio_puntos.min' => 'El precio en puntos debe ser al menos 0.',
            'premio.producto_id.required' => 'El ID del producto es obligatorio.',
            'premio.producto_id.exists' => 'El producto seleccionado no existe.',
            'premio.producto_id.unique' => 'Ya existe un premio con este producto.',
        ]);

        // Buscar el producto
        $prod = Producto::find($this->premio['producto_id']);

        // Validar que el stock del producto no sea menor al stock del premio
        if ($prod->stock < $this->premio['stock']) {
            $this->addError('premio.stock', 'El stock del producto no puede ser menor que la cantidad solicitada.');
            return;
        }

        $premio = Premio::create($this->premio);

        // Disminuir el stock del producto
        $prod->stock -= $this->premio['stock'];
        $prod->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Premio creado correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de un Premio";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Premio";
        $bitacora->registro_id = $premio->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.premios.index');
    }

    public function render()
    {
        return view('livewire.admin.premio.premio-create');
    }
}
