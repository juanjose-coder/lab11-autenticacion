@extends('layouts.app')
@section('title', 'Nueva contraseña')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h4 class="mb-3">Nueva contraseña</h4>
    <form method="POST" action="/reset-password">
        @csrf
        {{-- El token y el correo llegan en el enlace; la vista los recibe en $request --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="mb-3"><label class="form-label">Correo</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Nueva contraseña</label>
            <input type="password" name="password" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required></div>
        <button class="btn btn-primary w-100">Cambiar contraseña</button>
    </form>
</div></div>
@endsection
