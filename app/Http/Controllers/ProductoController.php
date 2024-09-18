<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'idCategoria' => 'required|exists:categoria,idCategoria',
            'nombreProducto' => 'required|string|max:75',
            'idSabor' => 'required|exists:sabor,idSabor',
            'idTamanio' => 'required|exists:tamanio,idTamanio',
            'precioVenta' => 'nullable|numeric|min:0',
            'cantidad' => 'nullable|integer|min:0',
            'imagen' => 'nullable|string|max:255', // 5MB Max
            'tipoGuardado' => 'required|in:1,2',
        ]);

        $producto = new Producto();
        $producto->fill($request->except('imagen', 'tipoGuardado'));

        // Generar código automáticamente
        $producto->codigo = $this->generarCodigo($request->idCategoria);

        // Asignar idProductoDestino basado en el tipo de guardado
        $producto->idProductoDestino = $request->tipoGuardado === 'catalogo' ? 1 : 2;

        // Manejar la carga de imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::slug($producto->nombreProducto) . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = $imagen->storeAs('public/productos', $nombreImagen);
            $producto->imagen = Storage::url($rutaImagen); // Esto guardará la URL pública
        }

        $producto->save();

        return response()->json([
            'success' => true,
            'message' => 'Producto guardado exitosamente',
            'producto' => $producto
        ]);
    }

    private function generarCodigo($idCategoria)
    {
        $ultimoProducto = Producto::where('idCategoria', $idCategoria)->latest('idProducto')->first();
        $numeroSecuencial = $ultimoProducto ? intval(substr($ultimoProducto->codigo, -4)) + 1 : 1;
        return sprintf('PROD%03d%04d', $idCategoria, $numeroSecuencial);
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
