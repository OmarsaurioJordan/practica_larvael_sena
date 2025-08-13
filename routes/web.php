<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
    //return view('index');
});

Route::resource('categorias', CategoriaController::class);
