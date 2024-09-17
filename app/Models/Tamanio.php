<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamanio extends Model
{
    use HasFactory;

    protected $table = 'tamanio'; 
    protected $primaryKey = 'idTamanio'; 
    public $timestamps = true; 

    protected $fillable = [
        'tamanio',
        'estado'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idTamanio', 'idTamanio');
    }
}

