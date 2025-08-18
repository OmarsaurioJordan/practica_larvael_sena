<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    public function accion() {
        return $this->belongsTo('App\Models\Accion');
    }

    public function rol() {
        return $this->belongsTo('App\Models\Rol');
    }
}
