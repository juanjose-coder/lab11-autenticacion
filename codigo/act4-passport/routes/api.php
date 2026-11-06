<?php

use App\Http\Controllers\Api\PassportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas públicas: no necesitan token.
Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);

// Rutas protegidas: 'auth:api' usa el guard "api" (driver passport) definido en config/auth.php.
// Sin el encabezado "Authorization: Bearer <token>" responden 401.
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [PassportAuthController::class, 'logout']);
});
