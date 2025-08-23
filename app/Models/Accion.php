<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rol;

class Accion extends Model
{
    public $fillable = [
        'nombre',
        'url',
        'modulo'
    ];

    public function permisos() {
        return $this->hashMany('App\Models\Permiso');
    }

    public function roles() {
        return $this->belongsToMany(
            Rol::class,
            'permisos',
            'accion_id',
            'rol_id'
        );
    }

}
