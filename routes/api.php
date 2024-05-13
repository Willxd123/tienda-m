<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriaApiCntroller;
use App\Http\Controllers\Api\FamiliaApiController;
use App\Http\Controllers\Api\ImagenApiController;
use App\Http\Controllers\Api\ProductoApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class, 'login']);
Route::get('/productos-categoria/{categoria}',[ProductoApiController::class, 'productosPorCategoria']);
Route::get('/productos',[ProductoApiController::class, 'todosLosProductos']);
Route::get('/productos-subcategoria/{categoria}',[ProductoApiController::class, 'productosPorSubCategoria']);
Route::get('/productos-imagenes/{id}',[ImagenApiController::class, 'imagenes']);
Route::get('/familias',[FamiliaApiController::class, 'index']);
Route::get('/categorias/{id}',[CategoriaApiCntroller::class, 'show']);
Route::get('/categorias',[CategoriaApiCntroller::class, 'index']);
Route::get('/producto/{id}',[ProductoApiController::class, 'show']);