<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public $fillable = [
        'nombre'
    ];

    public function usuarios() {
        return $this->hasMany('App\Models\Usuario');
    }

    public function permisos() {
        return $this->hasMany('App\Models\Permiso');
    }
}
