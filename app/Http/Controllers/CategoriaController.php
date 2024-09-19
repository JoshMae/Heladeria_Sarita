<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nombre= $request->input('nombre');

        $query = Categoria::where('estado', 1);

        if($nombre){
            $query->where('nombreCategoria', 'LIKE', '%' . $nombre . '%');
        }

        $categorias= $query->get();

        return response()->json($categorias);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'nombreCategoria' => 'required|string|max:45',
            'descripcion' => 'nullable|string|max:255'
        ]);

        $categoria= new Categoria();
        $categoria->fill($request->except(''));

        $categoria->estado = 1;
        
        $categoria -> save();
        return response()->json([
            'success' => true,
            'message' => 'Categoria guardada exitosamente',
            'producto' => $categoria
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        return response()->json($categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $validatedData = $request->validate([
            'nombreCategoria' => 'required|string|max:45',
            'descripcion' => 'nullable|string|max:255'
        ]);

        $categoria->update($validatedData);
        
        return response()->json([
            'success' => true,
            'message' => 'Categoria actualizada exitosamente',
            'producto' => $categoria
        ]);
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        
        $categoria->estado = 0;
        $categoria->save(); 
        
        return response()->json($categoria);
    }

}
