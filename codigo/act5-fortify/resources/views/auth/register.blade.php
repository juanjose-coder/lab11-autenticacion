@extends('layouts.app')
@section('title', 'Registro')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h4 class="mb-3">Crear cuenta</h4>
    <form method="POST" action="/register">
        @csrf
        <div class="mb-3"><label class="form-label">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Correo</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required></div>
        <button class="btn btn-success w-100">Registrarme</button>
    </form>
    <div class="mt-3"><a href="/login">¿Ya tienes cuenta? Inicia sesión</a></div>
</div></div>
@endsection
