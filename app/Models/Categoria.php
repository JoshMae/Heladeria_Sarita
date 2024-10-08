<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria'; 
    protected $primaryKey = 'idCategoria'; 
    public $timestamps = true; 

    protected $fillable = [
        'nombreCategoria',
        'descripcion',
        'estado'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idCategoria', 'idCategoria');
    }
}

