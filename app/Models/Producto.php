<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'idProducto';
    public $timestamps = true; 

    protected $fillable = [
        'idCategoria',
        'nombreProducto',
        'idSabor',
        'idTamanio',
        'precioVenta',
        'cantidad',
        'imagen',
        'estado'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }

    public function sabor()
    {
        return $this->belongsTo(Sabor::class, 'idSabor', 'idSabor');
    }

    public function tamanio()
    {
        return $this->belongsTo(Tamanio::class, 'idTamanio', 'idTamanio');
    }
}
