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
}
