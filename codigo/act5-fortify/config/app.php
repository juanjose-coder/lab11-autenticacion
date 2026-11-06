<?php

// Solo se muestra el arreglo 'providers' de config/app.php.
return [

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        // ...

        /*
         * Package Service Providers...
         */
        // ...

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\FortifyServiceProvider::class, // <-- se agrega este provider
    ],

];
