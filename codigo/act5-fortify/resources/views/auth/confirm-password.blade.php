@extends('layouts.app')
@section('title', 'Confirmar contraseña')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h4 class="mb-3">Confirmar contraseña</h4>
    <p class="text-muted">Zona segura: confirma tu contraseña para continuar.</p>
    <form method="POST" action="/user/confirm-password">
        @csrf
        <div class="mb-3"><label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required autofocus></div>
        <button class="btn btn-primary w-100">Confirmar</button>
    </form>
</div></div>
@endsection
