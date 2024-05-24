<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $promotor = Role::updateOrCreate(['name' => 'promotor']);

        Permission::create(['name' => 'admin.dashboard',
                            'description'=> 'Ver dashboard'])->syncRoles([$admin, $promotor]);

        //Permission::create(['name' => 'admin.users']);
        Permission::create(['name' => 'admin.users.index',
                            'description'=> 'Ver usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.create',
                            'description'=> 'Crear usuario'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit',
                            'description'=> 'Editar usuario'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.destroy',
                            'description'=> 'Eliminar usuario'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.familias']);
        Permission::create(['name' => 'admin.familias.index',
                            'description'=> 'Ver familias'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.familias.create',
                            'description'=> 'Crear familia'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.familias.edit',
                            'description'=> 'Editar familia'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.familias.destroy',
                            'description'=> 'Eliminar familiar'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.categorias']);
        Permission::create(['name' => 'admin.categorias.index',
                            'description'=> 'Ver categorias'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.categorias.create',
                            'description'=> 'Crear categoria'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.categorias.edit',
                            'description'=> 'Editar categoria'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.categorias.destroy',
                            'description'=> 'Eliminar categoria'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.subcategorias']);
        Permission::create(['name' => 'admin.subcategorias.index',
                            'description'=> 'Ver subcategorias'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.subcategorias.create',
                            'description'=> 'Crear subcategoria'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.subcategorias.edit',
                            'description'=> 'Editar subacategoria'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.subcategorias.destroy',
                            'description'=> 'Eliminar subcategoria'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.productos']);
        Permission::create(['name' => 'admin.productos.index',
                            'description'=> 'Ver productos'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.productos.create',
                            'description'=> 'Crear producto'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.productos.edit',
                            'description'=> 'Editar producto'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.productos.destroy',
                            'description'=> 'Eliminar producto'])->syncRoles([$admin]);
    
        //Permission::create(['name' => 'admin.premios']);
        Permission::create(['name' => 'admin.premios.index',
                            'description'=> 'Ver premios'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.premios.create',
                            'description'=> 'Crear premio'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.premios.edit',
                            'description'=> 'Editar premio'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.premios.destroy',
                            'description'=> 'Eliminar premio'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.proveedors']);
        Permission::create(['name' => 'admin.proveedors.index',
                            'description'=> 'Ver proveedores'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.proveedors.create',
                            'description'=> 'Crear proveedor'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.proveedors.edit',
                            'description'=> 'Editar proveedor'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.proveedors.destroy',
                            'description'=> 'Eliminar proveedor'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.nota_compras']);
        Permission::create(['name' => 'admin.nota_compras.index',
                            'description'=> 'Ver Nota de Compra'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.nota_compras.create',
                            'description'=> 'Crear nota de compra'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.nota_compras.ver',
                            'description'=> 'Detalle nota compra'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.bitacora']);
        Permission::create(['name' => 'admin.bitacora.index',
                            'description'=> 'Ver bitacora'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.roles']);
        Permission::create(['name' => 'admin.roles.index',
                            'description'=> 'Ver roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.create',
                            'description'=> 'Crear rol'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.edit',
                            'description'=> 'Editar rol'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.destroy',
                            'description'=> 'Eliminar rol'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.rangos']);
        Permission::create(['name' => 'admin.rangos.index',
                            'description'=> 'Ver rangos'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.rangos.create',
                            'description'=> 'Crear rango'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.rangos.edit',
                            'description'=> 'Editar rango'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.rangos.destroy',
                            'description'=> 'Eliminar rango'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.imagenes']);
        Permission::create(['name' => 'admin.imagenes.create',
                            'description'=> 'Crear imagenes'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.imagenes.store',
                            'description'=> 'Visualizar imagenes'])->syncRoles([$admin]);

    }
}
