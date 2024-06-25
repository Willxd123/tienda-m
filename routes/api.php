<?php

use App\Http\Controllers\Admin\NotaVentaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriaApiCntroller;
use App\Http\Controllers\Api\FamiliaApiController;
use App\Http\Controllers\Api\ImagenApiController;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\PromotorApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class, 'login']);
Route::post('/usuario',[AuthController::class, 'usuario']);
Route::get('/productos-categoria/{categoria}',[ProductoApiController::class, 'productosPorCategoria']);
Route::get('/productos',[ProductoApiController::class, 'todosLosProductos']);
Route::get('/productos-subcategoria/{categoria}',[ProductoApiController::class, 'productosPorSubCategoria']);
Route::get('/productos-imagenes/{id}',[ImagenApiController::class, 'imagenes']);
Route::get('/familias',[FamiliaApiController::class, 'index']);
Route::get('/categorias/{id}',[CategoriaApiCntroller::class, 'show']);
Route::get('/categorias',[CategoriaApiCntroller::class, 'index']);
Route::get('/producto/{id}',[ProductoApiController::class, 'show']);
Route::post('/familia',[FamiliaApiController::class, 'store']);
Route::post('/factura/{id}',[NotaVentaController::class, 'store']);
Route::get('/pdf-factura/{id}',[ProductoApiController::class, 'pdfFactura']);
Route::get('/pdf-factura/{id}/{prods}',[ProductoApiController::class, 'pdfFacturaUrl']);
Route::put('/promotor/{id}',[PromotorApiController::class, 'actualizarPuntos']);
Route::get('/prom/{id}',[PromotorApiController::class, 'promotor']);
Route::get('/prom-compras/{id}',[PromotorApiController::class, 'totalComprado']);
Route::get('/prom-historial/{id}',[PromotorApiController::class, 'historial']);



//Examen si2 reportes
Route::post('/examen',[PromotorApiController::class, 'examen']);
Route::post('/examenexcel',[PromotorApiController::class, 'examenexcel']);
