<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\SaborController;
use App\Http\Controllers\TamanioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DestinosController;

Route::get('/', function(){
    return view('layouts.app');
});

Route::get('/inicio', [HomeController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/catalogo2', [HomeController::class, 'catalogo2'])->name('catalogo2');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');
Route::get('/carrito', [HomeController::class, 'carrito'])->name('carrito');

Route::get('/cargar-vista/{vista}', [ContenidoController::class, 'cargarVista']);
Route::get('/cargar-contenido-inventario/{contenido}', [ContenidoController::class, 'cargarContenidoInventario']);
/* 
Route::resource('sabores', SaborController::class); */

Route::get('/destinos', [DestinosController::class, 'index']);

// routes/web.php
Route::get('/tienda', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/tienda', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
   
    Route::get('/tienda/inicio', function(){
        return view('layouts.administrador');
    });

    Route::get('/usuario', [HomeController::class, 'usuario'])->name('usuario');
    
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
    
    Route::get('/tamanios', [TamanioController::class, 'index']);
    Route::post('/tamanios', [TamanioController::class, 'store']);
    Route::get('/tamanios/{id}', [TamanioController::class, 'show']);
    Route::put('/tamanios/{id}', [TamanioController::class, 'update']);
    Route::delete('/tamanios/{id}', [TamanioController::class, 'destroy']);
    
    Route::get('/sabores', [SaborController::class, 'index']);
    Route::post('/sabores', [SaborController::class, 'store']);
    Route::get('/sabores/{id}', [SaborController::class, 'show']);
    Route::put('/sabores/{id}', [SaborController::class, 'update']);
    Route::delete('/sabores/{id}', [SaborController::class, 'destroy']);    
});