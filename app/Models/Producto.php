<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    public const STOCK_BAJO = 5; // a partir de aquí se alerta "stock bajo"

    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'categoria_id'];

    protected function casts(): array
    {
        return ['precio' => 'decimal:2'];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getStockBajoAttribute(): bool
    {
        return $this->stock <= self::STOCK_BAJO;
    }

    // Scope: búsqueda por nombre, categoría y stock bajo
    public function scopeFiltrar(Builder $query, array $f): Builder
    {
        return $query
            ->when($f['q'] ?? null, fn ($q, $v) => $q->where('nombre', 'like', "%{$v}%"))
            ->when($f['categoria'] ?? null, fn ($q, $v) => $q->where('categoria_id', $v))
            ->when($f['bajo'] ?? null, fn ($q) => $q->where('stock', '<=', self::STOCK_BAJO));
    }
}
