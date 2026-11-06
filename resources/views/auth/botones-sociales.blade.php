{{-- Pegar justo antes de </form> en resources/views/auth/login.blade.php --}}
{{-- Cada enlace llama a la ruta 'social.redirect' con el nombre del proveedor --}}
<div class="mt-4 text-center">
    <p class="text-sm text-gray-600 mb-2">O inicia sesión con:</p>
    <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}">Iniciar sesión con Facebook</a> |
    <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}">Iniciar sesión con Twitter</a> |
    <a href="{{ route('social.redirect', ['provider' => 'google']) }}">Iniciar sesión con Google</a>
</div>
