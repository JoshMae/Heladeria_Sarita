<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    protected $table = 'productodestino'; 
    protected $primaryKey = 'idProductoDestino'; 
    public $timestamps = false; 

    protected $fillable = [
        'destino',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idProductoDestino', 'idProductoDestino');
    }
}

