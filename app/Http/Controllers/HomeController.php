<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\String_;

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
        $images = $this->traerImagenes('Catalogo');
        dd($images);
        if (request()->ajax()) {
            return view('partials.catalogo', compact('images'))->render();
        }
        return view('index', compact('images'));
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

    //Funcion para traer Imagenes
    public function traerImagenes($vista){
        $images = DB::table('image')
                     ->where('vista', $vista)
                     ->get();
        return $images->groupBy('id');
    }
}