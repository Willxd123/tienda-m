<?php

namespace App\Livewire\Cliente\Premios;

use App\Http\Controllers\Admin\PremioPromotorController;
use App\Models\Bitacora;
use App\Models\PemioPromotor;
use App\Models\Premio;
use App\Models\Promotor;
use App\Models\PremioPromotor;
use Carbon\Carbon;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class Cange extends Component
{

    public $promotor;
    public $premio;
    public $qty = 1; //nombre del variable para sumar o restar cantidad


    public function mount()
    {
        if (auth()->check()) {
            $this->promotor = auth()->user();
        }
    }

    public function cange()
    {

        $user = Auth::user();


        $promotor = $user->promotor;

        // Verificar si el promotor tiene suficientes puntos para canjear el premio
        if ($promotor->puntos >= $this->premio->precio_puntos * $this->qty) {
            // Descuento de puntos del promotor
            $promotor->decrement('puntos', $this->premio->precio_puntos * $this->qty);

            // Crear registro en la tabla intermedia premio_promotor
            //$promotor->premios()->attach($this->premio->id, ['cantidad' => $this->qty]);
            $premio_promotor = PemioPromotor::create([
                'cantidad' => $this->qty,
                'fecha' => Carbon::now(),
                'premio_id' => $this->premio->id,
                'promotor_id'=> $promotor->id,
            ]);
            //dd($this->premio);

            // Actualizar el stock del premio
            //$this->premio->decrement('stock', $this->qty);

            $premio_dec = Premio::find($this->premio->id);
            //dd($premio_dec);
            $premio_dec->stock = $premio_dec->stock - $this->qty;
            $premio_dec->save();

            // Mostrar mensaje de éxito
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Canje completado',
                'text' => 'El premio ha sido canjeado con éxito.'
            ]);
        } else {
            // Mostrar mensaje de error si el promotor no tiene suficientes puntos
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'No tienes suficientes puntos',
                'text' => 'No tienes suficientes puntos para canjear este premio.'
            ]);
        }

            /*$bitacora = new Bitacora();
            $bitacora->descripcion = "Creacion de una Categoría";
            $bitacora->usuario = auth()->user()->name;
            $bitacora->usuario_id = auth()->user()->id;
            $bitacora->direccion_ip = $request->ip();
            $bitacora->navegador = $request->header('user-agent');
            $bitacora->tabla = "Categoría";
            $bitacora->registro_id = $premio_promotor->id;
            $bitacora->fecha_hora = Carbon::now();
            $bitacora->save();*/
    }


    public function render()
    {
        return view('livewire.cliente.premios.cange');
    }
}