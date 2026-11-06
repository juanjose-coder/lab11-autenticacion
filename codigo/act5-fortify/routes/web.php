<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Fortify registra por su cuenta /login, /register, /logout, /forgot-password,
// /reset-password, /user/confirm-password, /two-factor-challenge, /user/two-factor-authentication...
// Aquí solo definimos la página a la que llega el usuario autenticado.
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');
