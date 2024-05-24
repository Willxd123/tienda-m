<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\SubcategoriaController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FamiliaController;
use App\Http\Controllers\Admin\PremioController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\Producto;
use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('familias/{familia}', [FamiliaController::class, 'show'])->name('cliente.familias.show');
Route::get('categorias/{categoria}', [CategoriaController::class, 'show'])->name('cliente.categorias.show');
Route::get('subcategorias/{subcategoria}', [SubcategoriaController::class, 'show'])->name('cliente.subcategorias.show');
Route::get('productos/{producto}', [ProductoController::class, 'show'])->name('cliente.productos.show');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::get('premios', [PremioController::class, 'show'])->name('cliente.premios.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('prueba', function(){
    Cart::instance('shopping');
    return Cart::content();
});