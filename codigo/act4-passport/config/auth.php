<?php

// Solo se muestra el bloque 'guards' de config/auth.php (el resto no cambia).
return [

    'guards' => [
        // Guard web: usuarios del navegador, autenticados con sesión y cookies.
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard api: solicitudes de la API, autenticadas con el TokenGuard de Passport.
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

];
