@extends('layouts.app')
@section('contenido')
<h1>Crear cuenta</h1>
<form method="POST" action="{{ route('register') }}">
  @csrf
  <p><label>Nombre<br><input name="name" value="{{ old('name') }}" required></label></p>
  <p><label>Correo<br><input type="email" name="email" value="{{ old('email') }}" required></label></p>
  <p><label>Clave (mínimo 8)<br><input type="password" name="password" required></label></p>
  <p><label>Repite la clave<br><input type="password" name="password_confirmation" required></label></p>
  <button>Registrarme</button>
</form>
<p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
@endsection
