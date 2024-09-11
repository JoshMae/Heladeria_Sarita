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
        return view('index');
    }

    public function nosotros()
    {
        if (request()->ajax()) {
            return view('partials.nosotros')->render();
        }
        return view('index');
    }

    public function catalogo()
    {
        if (request()->ajax()) {
            return view('partials.catalogo')->render();
        }
        return view('index');
    }

    public function ubicacion()
    {
        if (request()->ajax()) {
            return view('partials.ubicacion')->render();
        }
        return view('index');
    }

    public function usuario()
    {
        if (request()->ajax()) {
            return view('usuario')->render();
        }
        return view('index');
    }

    public function carrito()
    {
        if (request()->ajax()) {
            return view('carrito')->render();
        }
        return view('index');
    }
}