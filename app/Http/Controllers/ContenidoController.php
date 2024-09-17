<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    public function cargarVista($vista)
    {
        if (view()->exists("contenido.$vista")) {
            return view("contenido.$vista");
        }

        return '<p>La vista solicitada no existe.</p>';
    }
}
