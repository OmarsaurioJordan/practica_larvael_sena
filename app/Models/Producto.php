<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $fillable = [
        'nombre',
        'descripcion',
        'foto',
        'precio',
        'cantidad',
        'categoria_id'
    ];

    public function categoria() {
        return $this->belongsTo('App\Models\Categoria');
    }
}
