<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Breeze: el panel solo se muestra a usuarios autenticados ('auth')
// y con el correo verificado ('verified', solo aplica si User implementa MustVerifyEmail).
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas del perfil del usuario: editar datos, cambiar contraseña y eliminar cuenta.
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/auth.php lo genera "php artisan breeze:install":
// contiene login, registro, recuperar contraseña, verificar correo y confirmar contraseña.
require __DIR__.'/auth.php';
