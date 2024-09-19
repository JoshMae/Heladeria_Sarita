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
        $destino= $request->input('destino');
        
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
        if ($destino) {
            $query->where(function($q) use ($destino) {
                $q->where('idProductoDestino', $destino)
                  ->orWhere('idProductoDestino', 1);
            });
        }        

        // Obtener los productos filtrados
        $productos = $query->with(['categoria', 'sabor', 'tamanio'])->get();

        // Retornar respuesta JSON para que se pueda mostrar en la tabla
        return response()->json($productos);
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        // Validaciones esenciales
        $request->validate([
            'idCategoria' => 'required|exists:categoria,idCategoria',
            'nombreProducto' => 'required|string|max:75',
            'idSabor' => 'required|exists:sabor,idSabor',
            'idTamanio' => 'required|exists:tamanio,idTamanio',
            'idProductoDestino' => 'required|exists:productodestino,idProductoDestino',
        ]);

        $producto = new Producto();
        $producto->fill($request->except('imagen'));

        // Generar código automáticamente
        $producto->codigo = $this->generarCodigo($request->idCategoria);

        // Asignar idProductoDestino
        $producto->idProductoDestino = $request->tipoGuardado === '1' ? 1 : 2;

        // Manejar la carga de imagen si se ha enviado una
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imageName = $imagen->getClientOriginalName();
            $imagen->move(public_path('catalogo'), $imageName);
            $producto->imagen = 'catalogo/' . $imageName;
        }

        $producto->estado = 1;
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
        return sprintf('%03d%04d', $idCategoria, min($numeroSecuencial, 9999));
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
        $request->validate([
            'idCategoria' => 'required',
            'nombreProducto' => 'required', 
            'idSabor' => 'required',
            'idTamanio' => 'required',
            'precioVenta' => 'nullable|numeric',
            'cantidad' => 'nullable|integer',
            'idProductoDestino' => 'required',
        ]);

        $producto = Producto::findOrFail($id);

        $producto->fill($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imageName = $imagen->getClientOriginalName();
            $imagen->move(public_path('catalogo'), $imageName);
            $producto->imagen = 'catalogo/' . $imageName;
        }

        $producto->save();

        return response()->json([
            'success' => true,
            'message' => 'Producto guardado exitosamente',
            'producto' => $producto
        ]);
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
