<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar todos los productos con estado 1
    public function index(Request $request)
    {
        // Filtros de búsqueda
        $codigo = $request->input('codigo');
        $nombre = $request->input('nombre');
        $idCategoria = $request->input('idCategoria');

        // Consulta base para obtener los productos con estado 1
        $query = Producto::where('estado', 1);

        // Aplicar filtros
        if ($codigo) {
            $query->where('codigo', 'LIKE', '%' . $codigo . '%');
        }
        if ($nombre) {
            $query->where('nombreProducto', 'LIKE', '%' . $nombre . '%');
        }
        if ($idCategoria) {
            $query->where('idCategoria', $idCategoria);
        }

        // Obtener los productos filtrados
        $productos = $query->with(['categoria', 'sabor', 'tamanio'])->get();

        // Retornar respuesta JSON para que se pueda mostrar en la tabla
        return response()->json($productos);
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'idCategoria' => 'required',
            'codigo' => 'required|unique:producto,codigo',
            'nombreProducto' => 'required',
            'idSabor' => 'required',
            'idTamanio' => 'required',
            'precioVenta' => 'required|numeric',
            'cantidad' => 'required|integer',
            'imagen' => 'nullable|image',
        ]);

        // Crear el nuevo producto
        $producto = Producto::create($request->all());

        // Retornar el producto recién creado
        return response()->json($producto, 201);
    }

    

    // Mostrar un producto específico para editar
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'idCategoria' => 'required',
            'codigo' => 'required|unique:producto,codigo,' . $id . ',idProducto',
            'nombreProducto' => 'required',
            'idSabor' => 'required',
            'idTamanio' => 'required',
            'precioVenta' => 'required|numeric',
            'cantidad' => 'required|integer',
            'imagen' => 'nullable|image',
        ]);

        // Encontrar el producto por su ID y actualizarlo
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        // Retornar el producto actualizado
        return response()->json($producto);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estado= 0;
        $producto->save();

        return response()->json(null, 204);
    }
}
