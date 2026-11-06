<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// --- Laravel Socialite ---
// {provider} puede ser facebook, twitter o google.
// Se nombran 'social.redirect' y 'social.callback' (y no 'login') porque Breeze ya usa
// el nombre 'login' para la pantalla de acceso con correo y contraseña.
Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.redirect');
Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
