@extends('layouts.app')
@section('title', 'Recuperar contraseña')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h4 class="mb-3">Recuperar contraseña</h4>
    {{-- Con MAIL_MAILER=log el enlace de restablecimiento queda en storage/logs/laravel.log --}}
    <form method="POST" action="/forgot-password">
        @csrf
        <div class="mb-3"><label class="form-label">Correo</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus></div>
        <button class="btn btn-primary w-100">Enviar enlace</button>
    </form>
</div></div>
@endsection
