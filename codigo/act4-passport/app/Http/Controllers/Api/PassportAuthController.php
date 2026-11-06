<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    // POST /api/register -> crea el usuario y devuelve su token de acceso.
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // createToken() usa el "personal access client" creado por passport:install.
        $token = $user->createToken('Lab11')->accessToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    // POST /api/login -> valida credenciales y devuelve un token nuevo.
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        // Auth::user() es el usuario que acaba de validar Auth::attempt()
        $token = Auth::user()->createToken('Lab11')->accessToken;

        return response()->json(['token' => $token]);
    }

    // POST /api/logout -> revoca el token con el que se hizo la solicitud.
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Sesión cerrada']);
    }
}
