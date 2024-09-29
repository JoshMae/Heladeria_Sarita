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

    

    public function catalogo2()
    {
        $image1 = $this->traerImagenes('1');
        $image2 = $this->traerImagenes('2');
        $image3 = $this->traerImagenes('3');
        $image4 = $this->traerImagenes('4');    
        
        if (request()->ajax()) {
            return view('partials.catalogo2', compact('image1','image2','image3','image4'))->render();
        }
        return view('index', compact('image1','image2','image3','image4'));
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
            return view('partials.usuario')->render();
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
    public function traerImagenes($id){
        $images = DB::table('image')
                     ->where('id', $id)
                     ->get();
        return $images;
    }
}