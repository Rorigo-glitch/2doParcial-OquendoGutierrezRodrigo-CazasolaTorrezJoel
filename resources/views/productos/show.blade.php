@extends('layouts.app')
@section('contenido')
<h1>{{ $producto->nombre }}</h1>
<p><b>Categoría:</b> {{ $producto->categoria->nombre }}</p>
<p><b>Descripción:</b> {{ $producto->descripcion ?: '—' }}</p>
<p><b>Precio:</b> Bs {{ $producto->precio }}</p>
<p><b>Stock:</b> <span class="{{ $producto->stock_bajo ? 'low' : '' }}">{{ $producto->stock }}</span></p>
<p><b>Registrado:</b> {{ $producto->created_at->format('d/m/Y H:i') }}</p>
<a class="btn" href="{{ route('productos.edit', $producto) }}">Editar</a>
<a class="btn gray" href="{{ route('productos.index') }}">Volver</a>
@endsection
