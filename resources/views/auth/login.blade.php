@extends('layouts.app')
@section('contenido')
<h1>Iniciar sesión</h1>
<form method="POST" action="{{ route('login') }}">
  @csrf
  <p><label>Correo<br><input type="email" name="email" value="{{ old('email') }}" required></label></p>
  <p><label>Clave<br><input type="password" name="password" required></label></p>
  <button>Entrar</button>
</form>
<p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
@endsection
