<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::where('estado', 1)->get();

        return response()->json($categorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreCategoria' => 'required|string|max:45',
            'descripcion' => 'nullable|string|max:255'
        ]);

        $validatedData['estado'] = 1;

        $categoria = Categoria::create($validatedData);
        return response()->json($categoria, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::where('idCategoria', $id)
                          ->where('estado', 1)
                          ->firstOrFail();

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
        return response()->json($categoria);
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
