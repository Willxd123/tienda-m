<?php

namespace App\Livewire\Admin\NotaCompra;

use App\Models\Bitacora;
use App\Models\NotaCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\DetalleCompra;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotaCompraCreate extends Component
{

    public $productos; //del select
    public $lista_productos = []; //agregar productos
    public $lista_productos_id = [];
    public $proveedores;
    public $nota_compras;
    public $totalCompra = 0;
    public $proveedor_id = '';
    public $header;

    public $producto = [
        'producto_id' => '',
        'stock' => '',
        'precio' => '',
    ];

    public function mount()
    {
        $this->proveedores = Proveedor::all();
        $this->productos = Producto::all();
        $this->nota_compras = new NotaCompra();
        $this->proveedor_id = '';
    }

    public function store(Request $request)
    {
        // Calcular el monto total y asignarlo a $this->header['monto_total']
        $this->header['monto_total'] = $this->getTotal();

        // Validar los datos de la NOTACOMPRA
        $this->validate([
            'proveedor_id' => 'required',
            'header.monto_total' => 'required',
        ], [
            'proveedor_id.required' => 'El campo Proveedor es obligatorio',
            'header.monto_total.required' => 'El campo Monto Total es obligatorio',
        ]);

        $notaCompra = new NotaCompra;
        $notaCompra->monto_total = $this->header['monto_total'];
        $notaCompra->proveedor_id = $this->proveedor_id;
        $notaCompra->fecha = now();
        $notaCompra->save();

        // Crear los detalles de compra asociados a la nota de compra
        foreach ($this->lista_productos as $producto) {
            DetalleCompra::create([
                'nota_compra_id' => $notaCompra->id,
                'producto_id' => $producto['producto_id'],
                'cantidad' => $producto['stock'],
                'precio' => $producto['precio'],
            ]);

            // Aumentar el stock del producto si es necesario
            $prod = Producto::find($producto['producto_id']);
            $prod->stock += $producto['stock'];
            $prod->save();
        }

        // Limpiar la lista de productos después de guardar
        $this->lista_productos = [];

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'Nota de Compra creado correctamente.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de una Nota de Compra";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Producto";
        $bitacora->registro_id = $notaCompra->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.nota_compras.index');
    }

    public function agregarProducto()
    {
        $this->validate([
            'producto.producto_id' => 'required',
            'producto.stock' => 'required|numeric',
            'producto.precio' => 'required|numeric',
        ], [
            'producto.producto_id.required' => 'El campo Producto es obligatorio',
            'producto.stock.required' => 'El campo Cantidad es obligatorio',
            'producto.stock.numeric' => 'El campo Cantidad debe ser un número',
            'producto.precio.required' => 'El campo Precio es obligatorio',
            'producto.precio.numeric' => 'El campo Precio debe ser un número',
        ]);

        $prod = Producto::find($this->producto['producto_id']);

        // Agregamos el producto a la lista de productos
        $this->lista_productos[] = [
            'producto_id' => $prod->id,
            'nombre' => $prod->nombre,
            'stock' => $this->producto['stock'],
            'precio' => $this->producto['precio'],
        ];

        // Limpia el formulario de agregar producto
        $this->producto = [
            'producto_id' => '',
            'stock' => '',
            'precio' => '',
        ];

        $this->totalCompra = $this->getTotal();
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->lista_productos as $producto) {
            $total += $producto['stock'] * $producto['precio'];
        }

        $this->totalCompra = $total;
        $this->nota_compras->monto_total = $total;

        return $total;
    }

    public function eliminarProducto($id)
    {
        foreach ($this->lista_productos as $key => $producto) {
            if ($producto['id'] == $id) {
                unset($this->lista_productos[$key]);
                $this->getTotal();
                break; // Detener el bucle una vez que se ha eliminado el producto
            }
        }

        $this->totalCompra = $this->getTotal();
    }

    public function render()
    {
        return view('livewire.admin.nota-compra.nota-compra-create');
    }
}