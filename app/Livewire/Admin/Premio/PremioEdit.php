<?php

namespace App\Livewire\Admin\Premio;

use App\Models\Bitacora;
use App\Models\Premio;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PremioEdit extends Component
{

    use WithFileUploads;
    public $premio;
    public $premioEdit;
    public $productos; //del selec
    public $originalStock;

    public function mount($premio)
    {
        $this->premioEdit = $premio->only('id', 'nombre', 'descripcion', 'stock', 'precio_puntos', 'imagen');
        $this->productos = Producto::all();
        $this->originalStock = $premio->stock; // Guardar el stock original
    }

    public function store(Request $request)
    {
        $this->validate([
            'premioEdit.stock' => 'required|numeric|min:0',
            'premioEdit.precio_puntos' => 'required|numeric|min:0',
            'premioEdit.producto_id' => 'required|exists:productos,id',
        ]);

        // Buscar el producto
        $prod = Producto::find($this->premioEdit['producto_id']);

        // Encuentra el premio existente y actualízalo
        $premio = Premio::findOrFail($this->premioEdit['id']);

        // Calcular la diferencia de stock
        $stockDifference = $this->originalStock - $this->premioEdit['stock'];

        // Ajustar el stock del producto
        $prod->stock += $stockDifference; // Sumar la diferencia

        if ($prod->stock < 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'El stock del producto no puede ser negativo.'
            ]);
            return redirect()->back();
        }

        $prod->save();

        // Actualizar el premio
        $premio->update($this->premioEdit);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de un Premio";
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
        return view('livewire.admin.premio.premio-edit');
    }
}
