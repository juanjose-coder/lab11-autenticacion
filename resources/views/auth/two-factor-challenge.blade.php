@extends('layouts.app')
@section('title', 'Verificación en dos pasos')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h4 class="mb-3">Verificación en dos pasos</h4>
    {{-- Se puede usar el código de la app autenticadora O un código de recuperación --}}
    <form method="POST" action="/two-factor-challenge">
        @csrf
        <div class="mb-3"><label class="form-label">Código de la aplicación</label>
            <input type="text" name="code" inputmode="numeric" class="form-control" autofocus></div>
        <div class="mb-3"><label class="form-label">O código de recuperación</label>
            <input type="text" name="recovery_code" class="form-control"></div>
        <button class="btn btn-primary w-100">Verificar</button>
    </form>
</div></div>
@endsection
