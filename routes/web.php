<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/catalogo', [HomeController::class, 'catalogo'])->name('catalogo');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');
Route::get('/usuario', [HomeController::class, 'usuario'])->name('usuario');
Route::get('/carrito', [HomeController::class, 'carrito'])->name('carrito');