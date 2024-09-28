<?php

namespace App\Http\Controllers;

use App\Models\Sabor;
use Illuminate\Http\Request;

class SaborController extends Controller
{
    // Mostrar lista de sabores con estado 1
    public function index(Request $request)
    {
        $sabor= $request->input('nombreSabor');

        $query = Sabor::where('estado', 1);
        if($sabor){
            $query->where('nombreSabor', $sabor);
        }
        $sabores= $query->get();

        return response()->json($sabores);
    }

    // Guardar nuevo sabor
    public function store(Request $request)
    {
        
        $request->validate([
            'nombreSabor' => 'required|max:75'
        ]);
        $sabor= new Sabor();
        $sabor->fill($request->except(''));
        $sabor->estado=1;
        $sabor->save();

        return response()->json([
            'success'=> true, 
            'message'=>'Sabor creado exitosamente.',
            'sabor'=>$sabor
        ]);
    }

    public function show(string $id){
        $sabor= Sabor::findOrFail($id);
        
        return response()->json($sabor);
    }

    // Actualizar sabor existente
    public function update(Request $request, string $id)
    {   
        $sabor= Sabor::findOrFail($id);
        $dato=$request->validate([
            'nombreSabor' => 'required|max:75'
        ]);

        $sabor->update($dato);

        return response()->json([
            'success'=> true, 
            'message'=>'Sabor actualizado exitosamente.',
            'sabor'=>$sabor
        ]);
    }

    // "Eliminar" sabor (cambiar estado a 0)
    public function destroy(string $id)
    {
        $sabor= Sabor::findOrFail($id);
        $sabor->estado=0;
        $sabor->save();

        return response()->json([
            'success'=> true, 
            'message'=>'Sabor eliminado exitosamente.',
            'sabor'=>$sabor
        ]);
    }
}
