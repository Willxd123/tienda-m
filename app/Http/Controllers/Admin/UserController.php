<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Bitacora;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'permission:admin.users.index'])->only(['index', 'show']);
        $this->middleware(['auth', 'permission:admin.users.create'])->only(['create', 'store']);
        $this->middleware(['auth', 'permission:admin.users.edit'])->only(['edit', 'update']);
        $this->middleware(['auth', 'permission:admin.users.destroy'])->only(['destroy']);
    }

    public function index()
    {
        $users = User::where('email', '!=', 'admin@gmail.com')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'roles' => 'required|array',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'El nombre ya se encuentra registrado',
            'email.required' => 'El campo correo es obligatorio',
            'password.required' => 'La contraseña debe tener un minimo de 8 caracteres',
            'roles.required' => 'Se debe asignar un rol'
        ]);

        // Crea el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, //bcrypt($request->password),
        ]);

        $user->syncRoles($request->roles);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El usuario fue creado correctamente',
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de un Usuario";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Usuario";
        $bitacora->registro_id = $user->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.users.index');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'roles' => 'required|array',
        ]);

        // Actualiza los datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Asigna roles al usuario
        $user->syncRoles($request->roles);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El usuario fue actualizado correctamente',
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualización de un Usuario";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Usuario";
        $bitacora->registro_id = $user->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user, Request $request)
    {
        $user->roles()->detach();
        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente!',
            'text' => 'El usuario fue eliminado.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de un Usuario";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Usuario";
        $bitacora->registro_id = $user->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.users.index');
    }
}
