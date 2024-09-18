<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\SaborController;
use App\Http\Controllers\TamanioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;


Route::get('/', [HomeController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/catalogo', [HomeController::class, 'catalogo'])->name('catalogo');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');
Route::get('/usuario', [HomeController::class, 'usuario'])->name('usuario');
Route::get('/carrito', [HomeController::class, 'carrito'])->name('carrito');

Route::get('/cargar-vista/{vista}', [ContenidoController::class, 'cargarVista']);
Route::get('/cargar-contenido-inventario/{contenido}', [ContenidoController::class, 'cargarContenidoInventario']);

Route::resource('sabores', SaborController::class);

Route::get('/tamanios', [TamanioController::class, 'index']);

Route::get('/tienda/inicio', function(){
    return view('layouts.administrador');
});




Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');



Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

