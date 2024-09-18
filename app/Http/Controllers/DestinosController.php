<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class DestinosController extends Controller
{
    function index(){
        $destinos= Destino::all();
        return response()->json($destinos);
    }
}
