<?php

namespace App\Http\Controllers;

use App\Models\Sabor;
use Illuminate\Http\Request;

class SaborController extends Controller
{
    // Mostrar lista de sabores con estado 1
    public function index()
    {
        $sabores = Sabor::where('estado', 1)->get();
        return view('sabor.index', compact('sabores'));
    }
/* 
    // Mostrar formulario de creación
    public function create()
    {
        return view('sabor.create');
    }
 */
    // Guardar nuevo sabor
    public function store(Request $request)
    {
        $request->validate([
            'nombreSabor' => 'required|max:75'
        ]);

        Sabor::create([
            'nombreSabor' => $request->nombreSabor,
            'estado' => 1
        ]);

        return redirect()->route('sabor.index')->with('success', 'Sabor creado exitosamente.');
    }

/*     // Mostrar formulario de edición
    public function edit(Sabor $sabor)
    {
        return view('sabor.edit', compact('sabor'));
    }
 */
    // Actualizar sabor existente
    public function update(Request $request, Sabor $sabor)
    {
        $request->validate([
            'nombreSabor' => 'required|max:75'
        ]);

        $sabor->update([
            'nombreSabor' => $request->nombreSabor
        ]);

        return redirect()->route('sabor.index')->with('success', 'Sabor actualizado exitosamente.');
    }

    // "Eliminar" sabor (cambiar estado a 0)
    public function destroy(Sabor $sabor)
    {
        $sabor->update(['estado' => 0]);

        return redirect()->route('sabor.index')->with('success', 'Sabor eliminado exitosamente.');
    }
}
