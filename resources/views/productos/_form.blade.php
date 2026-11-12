<p><label>Nombre<br><input name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" required></label></p>
<p><label>Descripción<br><textarea name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea></label></p>
{{-- Sin atributo min a propósito: el backend es quien valida --}}
<p><label>Precio (Bs)<br><input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio ?? '') }}" required></label></p>
<p><label>Stock<br><input type="number" name="stock" value="{{ old('stock', $producto->stock ?? '') }}" required></label></p>
<p><label>Categoría<br>
  <select name="categoria_id" required>
    <option value="">— elige —</option>
    @foreach ($categorias as $c)
      <option value="{{ $c->id }}" @selected(old('categoria_id', $producto->categoria_id ?? '') == $c->id)>{{ $c->nombre }}</option>
    @endforeach
  </select></label></p>
<button>Guardar</button> <a class="btn gray" href="{{ route('productos.index') }}">Cancelar</a>
