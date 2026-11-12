@extends('layouts.app')
@section('contenido')
<h1>Panel</h1>
<div class="cards">
  <div class="card"><b>{{ $total }}</b>productos</div>
  <div class="card"><b>Bs {{ number_format($valor, 2) }}</b>valor del inventario</div>
  <div class="card"><b class="low">{{ $bajo }}</b><a href="{{ route('productos.index', ['bajo' => 1]) }}">con stock bajo</a></div>
</div>
<h2>Productos por categoría</h2>
<table>
  <tr><th>Categoría</th><th>Productos</th></tr>
  @forelse ($categorias as $c)
    <tr><td><a href="{{ route('productos.index', ['categoria' => $c->id]) }}">{{ $c->nombre }}</a></td><td>{{ $c->productos_count }}</td></tr>
  @empty
    <tr><td colspan="2">Aún no hay categorías.</td></tr>
  @endforelse
</table>
@endsection
