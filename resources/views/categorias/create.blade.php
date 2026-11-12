@extends('layouts.app')
@section('contenido')
<h1>Nueva categoría</h1>
<form method="POST" action="{{ route('categorias.store') }}">
  @csrf
  <p><label>Nombre<br><input name="nombre" value="{{ old('nombre') }}" required></label></p>
  <button>Guardar</button> <a class="btn gray" href="{{ route('productos.index') }}">Cancelar</a>
</form>
@endsection
