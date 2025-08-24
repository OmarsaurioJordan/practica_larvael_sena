<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accion;

class Rol extends Model
{
    public $fillable = [
        'nombre'
    ];

    public function usuarios() {
        return $this->hasMany('App\Models\Usuario');
    }
}
