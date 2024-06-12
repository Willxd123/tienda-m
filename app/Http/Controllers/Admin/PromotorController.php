<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Promotor;
use App\Models\Rango;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PromotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotores = Promotor::with('user', 'rango')->orderBy('id', 'desc')->paginate(10);
        return view('admin.promotors.index', compact('promotores'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.promotors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'telefono' => 'required|integer',
            'nit' => 'required|integer',
            'direccion' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'telefono.required' => 'El teléfono es obligatorio.',
            'nit.required' => 'El nit es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Crear el usuario primero
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('promotor');
        $rango = Rango::find(1);

        // Crear el promotor y vincularlo al usuario creado
        $promotor = Promotor::create([
            'telefono' => $request->telefono,
            'nit' => $request->nit,
            'direccion' => $request->direccion,
            'puntos' => 0,
            'rango_id' => $rango->id,
            'user_id' => $user->id,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El promotor fue creado correctamente',
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de un Promotor";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Promotor";
        $bitacora->registro_id = $promotor->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.promotors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotor $promotor)
    {
        return view('admin.promotors.edit', compact('promotor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotor $promotor)
    {
        $request->validate([
            'telefono' => 'required|integer',
            'nit' => 'required|integer',
            'direccion' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $promotor->user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'telefono.required' => 'El teléfono es obligatorio.',
            'nit.required' => 'El nit es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        // Actualizar datos del usuario
        $user = $promotor->user;
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Actualizar datos del promotor
        $promotor->update([
            'telefono' => $request->telefono,
            'nit' => $request->nit,
            'direccion' => $request->direccion,
        ]);

        // Registrar en la bitácora
        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de un Proveedor";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Proveedor";
        $bitacora->registro_id = $promotor->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El promotor fue actualizado correctamente',
        ]);

        return redirect()->route('admin.promotors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Promotor $promotor)
    {
        $promotor->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente!',
            'text' => 'El promotor fue eliminado.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de un Proveedor";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Proveedor";
        $bitacora->registro_id = $promotor->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.promotors.index');
    }
}
