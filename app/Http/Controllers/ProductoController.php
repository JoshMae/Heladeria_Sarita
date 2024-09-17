<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos= Producto::where('estado', 1)->get();
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'idCategoria' => 'required|integer|exists:categorias,idCategoria',
            'nombreProducto' => 'required|string|max:50',
            'idSabor' => 'required|integer|exists:sabores,idSabor',
            'idTamanio' => 'required|integer|exists:tamanios,idTamanio',
            'precioVenta' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'imagen' => 'nullable|string|max:255',
        ]);

        $validatedData['estado'] = 1;

        $producto = Producto::create($validatedData);

        return response()->json($producto, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto= Producto::where('idProducto', $id)
                    ->where('estado', 1)
                    ->firstOrFail();
        
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $producto = Producto::findOrFail($id);

        $validatedData = $request->validate([
            'idCategoria' => 'nullable|integer|exists:categorias,idCategoria',
            'nombreProducto' => 'nullable|string|max:50',
            'idSabor' => 'nullable|integer|exists:sabores,idSabor',
            'idTamanio' => 'nullable|integer|exists:tamanios,idTamanio',
            'precioVenta' => 'nullable|numeric|min:0',
            'cantidad' => 'nullable|integer|min:0',
            'imagen' => 'nullable|string|max:255',
            'estado' => 'nullable|integer|in:0,1'
        ]);

        $producto->update($validatedData);

        return response()->json($producto);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto= Producto::findOrFail($id);

        $producto->estado= 0;
        $producto->save();

        return response()->json($producto);
    }
}
