<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
/* use Illuminate\Database\Eloquent\Model;
 */
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario', 
        'password', 
        'idRol'
    ];

    protected $hidden = [
        'password', 'passwordAnterior',
    ];

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'idRol', 'idRol');
    }

    public function validatePassword($password)
    {
        if (Hash::needsRehash($this->password)) {
            // Si la contraseña no está hasheada con Bcrypt, verificamos directamente
            return $this->password === $password;
        }
        
        // Si está hasheada con Bcrypt, usamos el método de verificación estándar
        return Hash::check($password, $this->password);
    }

    public function getAuthIdentifierName()
    {
        return 'usuario';
    }
}
