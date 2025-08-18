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

    Route::get('home', function () {
        return view('index');
    });

    Route::resource('categorias', CategoriaController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('rols', RolController::class);
});
