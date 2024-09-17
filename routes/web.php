<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\SaborController;
use App\Http\Controllers\TamanioController;


Route::get('/', [HomeController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/catalogo', [HomeController::class, 'catalogo'])->name('catalogo');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');
Route::get('/usuario', [HomeController::class, 'usuario'])->name('usuario');
Route::get('/carrito', [HomeController::class, 'carrito'])->name('carrito');


Route::resource('sabor', SaborController::class);

Route::get('/tamanios', [TamanioController::class, 'index'])->name('tamanios.index');

Route::get('/tienda/inicio', function(){
    return view('layouts.administrador');
});

