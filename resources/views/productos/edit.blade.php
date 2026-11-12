@extends('layouts.app')
@section('contenido')
<h1>Editar {{ $producto->nombre }}</h1>
<form method="POST" action="{{ route('productos.update', $producto) }}">
  @csrf @method('PUT')
  @include('productos._form')
</form>
@endsection
