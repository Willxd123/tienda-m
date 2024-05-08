<?php
//use Illuminate\Http\Request;

use App\Http\Controllers\Admin\BitacoraController;
use App\Http\Controllers\Admin\FamiliaController;
use App\Http\Controllers\Admin\SubcategoriaController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\NotaCompraController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ImageController;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('familias', FamiliaController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('subcategorias', SubcategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('proveedors', ProveedorController::class);
Route::get('/admin-bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
Route::resource('nota_compras', NotaCompraController::class);
Route::resource('users', UserController::class);
Route::get('/imagenes/{id}', [ImageController::class, 'create'])->name('imagenes.create');
Route::post('/imagenes/{id}', [ImageController::class, 'store'])->name('imagenes.store');
