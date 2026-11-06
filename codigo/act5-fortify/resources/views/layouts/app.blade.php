<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laboratorio 11 - Fortify')</title>
    {{-- Fortify no trae front-end: se usa Bootstrap desde CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">Laboratorio 11 · Fortify</span>
            @auth
                <form method="POST" action="/logout" class="m-0">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                </form>
            @endauth
        </div>
    </nav>
    <main class="container" style="max-width: 520px;">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
