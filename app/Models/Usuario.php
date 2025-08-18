<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    public $fillable = [
        'nombre',
        'telefono',
        'rol_id',
        'email',
        'password'
    ];

    public function rol() {
        return $this->belongsTo('App\Models\Rol');
    }
}
