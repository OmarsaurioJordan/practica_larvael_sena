<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ProductoController;

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
    Route::resource('productos', ProductoController::class);
    Route::resource('usuarios', UsuarioController::class);

    // estos son los middleware de uso individual, pero se comenta porque se usa el colectivo "verificarpermiso" que depende de los controladores, acciones y permisos en la DB, si se piensa usar estos individuales para rol, descomentar tambien en app.php
    /*
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
    */

    // como no se usan los middleware de acceso individual, sino que se establecio "verificarpermiso" desde los controllers, entonces aqui hay que poner esto
    Route::resource('categorias', CategoriaController::class);    
    Route::resource('rols', RolController::class);
});
