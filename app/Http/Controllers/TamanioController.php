<?php

namespace App\Http\Controllers;

use App\Models\Tamanio;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TamanioController extends Controller
{
    public function index(){
        $tamanios= Tamanio::where('estado',1)->get();
        return response()->json($tamanios);
    }
}
