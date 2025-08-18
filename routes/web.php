<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    //return view('welcome');
    return view('index');
});

Route::resource('categorias', CategoriaController::class);
Route::resource('usuarios', UsuarioController::class);
