<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    // 'hashed': la clave se guarda con hash (bcrypt), nunca en texto plano
    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }
}
