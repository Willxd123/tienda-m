<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
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
        ]);

        // Crea el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
        ]);

        // Asigna los roles al usuario
        $user->syncRoles($request->roles);

        // Asigna roles al usuario
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El usuario fue creado correctamente',
        ]);

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
    
        return redirect()->route('admin.users.index');
    }
    
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete(); 

        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Excelente!',
            'text' => 'El usuario fue eliminado.'
        ]);

        return redirect()->route('admin.users.index' );
    }
}
