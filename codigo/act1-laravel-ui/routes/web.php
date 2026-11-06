<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Página de bienvenida que trae Laravel por defecto
Route::get('/', function () {
    return view('welcome');
});

// Laravel UI: Auth::routes() registra TODAS las rutas de autenticación de una sola vez:
//   /login, /register, /logout, /password/reset, /password/email, /password/confirm ...
Auth::routes();

// Ruta /home: el HomeController (generado por "php artisan ui vue --auth") exige sesión iniciada.
// En Laravel 10 se usa la sintaxis de arreglo [Clase::class, 'metodo'] en lugar de 'HomeController@index'.
Route::get('/home', [HomeController::class, 'index'])->name('home');
