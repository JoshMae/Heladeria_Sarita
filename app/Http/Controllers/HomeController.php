<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function inicio()
    {
        if (request()->ajax()) {
            return view('partials.inicio')->render();
        }
        return view('inicio');
    }

    public function nosotros()
    {
        if (request()->ajax()) {
            return view('nosotros')->render();
        }
        return view('nosotros');
    }

    public function catalogo()
    {
        if (request()->ajax()) {
            return view('catalogo')->render();
        }
        return view('catalogo');
    }

    public function ubicacion()
    {
        if (request()->ajax()) {
            return view('partials.ubicacion')->render();
        }
        return view('ubicacion');
    }

    public function usuario()
    {
        if (request()->ajax()) {
            return view('usuario')->render();
        }
        return view('usuario');
    }

    public function carrito()
    {
        if (request()->ajax()) {
            return view('carrito')->render();
        }
        return view('carrito');
    }
}