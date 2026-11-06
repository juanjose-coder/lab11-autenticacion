@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<div class="card shadow-sm mb-3"><div class="card-body">
    <h4>Hola, {{ auth()->user()->name }}</h4>
    <p class="text-muted mb-0">Sesión iniciada con Laravel Fortify.</p>
</div></div>

<div class="card shadow-sm"><div class="card-body">
    <h5>Autenticación en dos pasos (2FA)</h5>

    @if (! auth()->user()->two_factor_secret)
        {{-- 1) Activar: Fortify genera el secreto. Pide confirmar la contraseña si no se hizo hace poco. --}}
        <form method="POST" action="/user/two-factor-authentication">
            @csrf
            <button class="btn btn-primary">Activar 2FA</button>
        </form>
    @else
        @if (! auth()->user()->two_factor_confirmed_at)
            {{-- 2) Escanear el QR con Google Authenticator y confirmar con un código --}}
            <p>Escanea este código QR con tu aplicación autenticadora:</p>
            <div class="mb-3">{!! auth()->user()->twoFactorQrCodeSvg() !!}</div>
            <form method="POST" action="/user/confirmed-two-factor-authentication" class="mb-3">
                @csrf
                <input type="text" name="code" class="form-control mb-2" placeholder="Código de 6 dígitos" required>
                <button class="btn btn-success">Confirmar</button>
            </form>
        @else
            <div class="alert alert-success">2FA activado y confirmado.</div>
        @endif

        {{-- 3) Códigos de recuperación: sirven si pierdes el celular --}}
        <p class="mb-1"><strong>Códigos de recuperación:</strong></p>
        <ul>
            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                <li><code>{{ $code }}</code></li>
            @endforeach
        </ul>

        <form method="POST" action="/user/two-factor-authentication">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">Desactivar 2FA</button>
        </form>
    @endif
</div></div>
@endsection
