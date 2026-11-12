@extends('layouts.app')
@section('contenido')
<h1>Productos</h1>
<form method="GET" action="{{ route('productos.index') }}" class="bar">
  <input name="q" value="{{ request('q') }}" placeholder="Buscar por nombre">
  <select name="categoria">
    <option value="">Todas las categorías</option>
    @foreach ($categorias as $c)
      <option value="{{ $c->id }}" @selected(request('categoria') == $c->id)>{{ $c->nombre }}</option>
    @endforeach
  </select>
  <label><input type="checkbox" name="bajo" value="1" @checked(request('bajo'))> Solo stock bajo</label>
  <button>Filtrar</button>
  <a class="btn gray" href="{{ route('productos.index') }}">Limpiar</a>
</form>
<p class="bar">
  <a class="btn" href="{{ route('productos.create') }}">+ Nuevo producto</a>
  <a class="btn" href="{{ route('categorias.create') }}">+ Nueva categoría</a>
  <a class="btn gray" href="{{ route('productos.exportar', request()->query()) }}">Exportar CSV</a>
</p>
<table>
  <tr><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Ajustar (+/−)</th><th></th></tr>
  @forelse ($productos as $p)
  <tr>
    <td><a href="{{ route('productos.show', $p) }}">{{ $p->nombre }}</a></td>
    <td>{{ $p->categoria->nombre }}</td>
    <td>Bs {{ $p->precio }}</td>
    <td class="{{ $p->stock_bajo ? 'low' : '' }}">{{ $p->stock }}{{ $p->stock_bajo ? ' ⚠' : '' }}</td>
    <td>
      <form method="POST" action="{{ route('productos.stock', $p) }}" class="inline">
        @csrf @method('PATCH')
        <input type="number" name="cantidad" value="1" required><button>Aplicar</button>
      </form>
    </td>
    <td>
      <a class="btn" href="{{ route('productos.edit', $p) }}">Editar</a>
      <form method="POST" action="{{ route('productos.destroy', $p) }}" class="inline" onsubmit="return confirm('¿Borrar {{ $p->nombre }}?')">
        @csrf @method('DELETE')<button class="danger">Borrar</button>
      </form>
    </td>
  </tr>
  @empty
    <tr><td colspan="6">No hay productos con esos filtros.</td></tr>
  @endforelse
</table>
@endsection
