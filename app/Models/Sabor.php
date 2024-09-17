<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
    use HasFactory;

    protected $table = 'sabor'; 
    protected $primaryKey = 'idSabor'; 
    public $timestamps = true;

    protected $fillable = [
        'nombreSabor',
        'estado'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idSabor', 'idSabor');
    }
}
