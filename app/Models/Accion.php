<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
