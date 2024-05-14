<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $permisos = Permission::all();
        return view('admin.roles.create', compact('permisos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permisos' => 'required|array|min:1'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'El nombre ya se encuentra registrado',
            'permisos.required' => 'Debe seleccionar al menos un permiso',
        ]);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permisos', []));

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El rol fue creado correctamente',
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Creación de un Rol";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Rol";
        $bitacora->registro_id = $role->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.roles.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('admin.roles.edit', compact('role', 'permisos'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'El nombre ya se encuentra registrado',
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->input('permisos', []));

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El rol fue creado actualizado',
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Actualizacion de un Rol";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Rol";
        $bitacora->registro_id = $role->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.roles.index');
    }


    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        session()->flash('swal',[
            'icon'=> 'success',
            'title'=>'Excelente!',
            'text' => 'El rol fue eliminado.'
        ]);

        $bitacora = new Bitacora();
        $bitacora->descripcion = "Eliminación de un Rol";
        $bitacora->usuario = auth()->user()->name;
        $bitacora->usuario_id = auth()->user()->id;
        $bitacora->direccion_ip = $request->ip();
        $bitacora->navegador = $request->header('user-agent');
        $bitacora->tabla = "Rol";
        $bitacora->registro_id = $role->id;
        $bitacora->fecha_hora = Carbon::now();
        $bitacora->save();

        return redirect()->route('admin.roles.index' );

    }
}
