<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;

Route::get('/', function () {
    if (Auth::check()) {
        return view('index');
    }
    else {
        return view('login');
    }
});
Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('Check', [UsuarioController::class, 'check']);
Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::middleware(['auth'])->group(function () {
    // solo si esta logeado
    Route::get('home', function () {
        return view('index');
    });
    Route::resource('usuarios', UsuarioController::class);

    // estos son los middleware de uso individual, se usa el colectivo conectado a la DB mediante acciones y permisos

    Route::middleware(['administrador'])->group(function () {
        // solo rol administrador
        Route::resource('categorias', CategoriaController::class);    
        Route::resource('rols', RolController::class);
    });

    Route::middleware(['comprador'])->group(function () {
        // solo rol comprador
    });

    Route::middleware(['vendedor'])->group(function () {
        // solo rol vendedor
    });
});
