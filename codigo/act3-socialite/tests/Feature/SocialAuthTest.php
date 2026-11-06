<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

// Prueba el flujo de Socialite SIN claves reales: se simula la respuesta de Google.
// DatabaseTransactions deshace los cambios al terminar (no borra la base de datos del laboratorio).
class SocialAuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_callback_de_google_crea_usuario_y_autentica(): void
    {
        // Usuario falso que "devuelve" Google
        $googleUser = Mockery::mock('Laravel\Socialite\Two\User');
        $googleUser->shouldReceive('getId')->andReturn('123456789')
            ->shouldReceive('getName')->andReturn('Usuario Google')
            ->shouldReceive('getNickname')->andReturn('ugoogle')
            ->shouldReceive('getEmail')->andReturn('google@lab11.test');

        // Driver falso: cuando el controlador pida ->user(), devuelve el usuario falso
        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($googleUser);
        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get('/login/google/callback');

        $response->assertRedirect('/dashboard');   // al terminar va al panel
        $this->assertAuthenticated();              // el usuario quedó con sesión iniciada
        $this->assertDatabaseHas('users', [        // y se guardó con los datos de la red social
            'email' => 'google@lab11.test',
            'provider' => 'google',
            'provider_id' => '123456789',
        ]);
    }

    public function test_proveedor_no_permitido_devuelve_404(): void
    {
        $this->get('/login/github')->assertNotFound();
    }
}
