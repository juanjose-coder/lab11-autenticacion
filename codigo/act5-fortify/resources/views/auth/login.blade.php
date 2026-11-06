@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h4 class="mb-3">Iniciar sesión</h4>
    {{-- Fortify recibe este formulario en POST /login --}}
    <form method="POST" action="/login">
        @csrf {{-- token anti-CSRF: sin él Laravel responde 419 --}}
        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label for="remember" class="form-check-label">Recordarme</label>
        </div>
        <button class="btn btn-primary w-100">Ingresar</button>
    </form>
    <div class="mt-3 d-flex justify-content-between">
        <a href="/forgot-password">¿Olvidaste tu contraseña?</a>
        <a href="/register">Crear cuenta</a>
    </div>
</div></div>
@endsection
