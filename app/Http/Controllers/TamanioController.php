<?php

namespace App\Http\Controllers;

use App\Models\Tamanio;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TamanioController extends Controller
{
    public function index(Request $request){
        $tamanio= $request->input('tamanio');
        $query= Tamanio::where('estado',1);
        if($tamanio){
            $query->where('tamanio','LIKE', '%' . $tamanio . '%');
        }
        $tamanios= $query->get();
        
        return response()->json($tamanios);
    }

    public function store(Request $request){
        $request->validate([
            'tamanio'=> 'required|string|max:45'
        ]);

        $tamanio= new Tamanio();
        $tamanio-> fill($request->except(''));
        $tamanio->estado=1;
        $tamanio->save();

        return response()->json([
            'success' => true,
            'message' => 'Tamaño guardado exitosamente',
            'producto' => $tamanio
        ]);
    }

    public function show(string $id){
        $tamanio= Tamanio::findOrFail($id);
        
        if($tamanio && $tamanio->estado==1){
            return response()->json($tamanio);
        }

    }

    public function update(string $id, Request $request){
        $tamanio= Tamanio::findOrFail($id);

        $datos= $request->validate([
            'tamanio'=> 'required|string|max:45'
        ]);

        $tamanio->update($datos);

        return response()->json([
            'success' => true,
            'message' => 'Tamaño actualizado exitosamente',
            'producto' => $tamanio
        ]);
    }

    public function destroy(string $id){
        $tamanio= Tamanio::findOrFail($id);
        $tamanio->estado=0;
        $tamanio->save();

        return response()->json([
            'success' => true,
            'message' => 'Tamaño eliminado exitosamente',
            'producto' => $tamanio
        ]);
    }
}
