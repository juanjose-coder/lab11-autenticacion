<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    // Proveedores permitidos: evita que se invoque un driver que no configuramos.
    private array $providers = ['facebook', 'twitter', 'google'];

    // Paso 1: envía al usuario a la página de inicio de sesión de la red social.
    public function redirectToProvider(string $provider)
    {
        abort_unless(in_array($provider, $this->providers), 404);

        return Socialite::driver($provider)->redirect();
    }

    // Paso 2: la red social devuelve al usuario aquí, ya autenticado en su plataforma.
    public function handleProviderCallback(string $provider)
    {
        abort_unless(in_array($provider, $this->providers), 404);

        // Datos del usuario entregados por la red social (id, nombre, correo...).
        $social = Socialite::driver($provider)->user();

        // Algunas redes (p. ej. Twitter) no entregan correo: se genera uno interno.
        $email = $social->getEmail() ?? $social->getId().'@'.$provider.'.local';

        // 1) ¿ya entró antes con esta red? 2) ¿existe un usuario con ese correo? 3) crear uno nuevo.
        $user = User::where('provider', $provider)->where('provider_id', $social->getId())->first()
            ?? User::where('email', $email)->first();

        if (! $user) {
            $user = User::create([
                'name'     => $social->getName() ?? $social->getNickname() ?? 'Usuario',
                'email'    => $email,
                'password' => Str::random(32), // contraseña aleatoria: solo entrará con la red social
            ]);
        }

        // Se vincula la cuenta con la red social usada.
        $user->update(['provider' => $provider, 'provider_id' => $social->getId()]);

        Auth::login($user, true); // true = "recordarme"

        return redirect()->to('/dashboard');
    }
}
