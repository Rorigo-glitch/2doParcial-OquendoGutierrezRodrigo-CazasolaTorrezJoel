<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class PanelController extends Controller
{
    public function __invoke()
    {
        return view('panel', [
            'total' => Producto::count(),
            'valor' => Producto::query()->selectRaw('COALESCE(SUM(precio * stock), 0) as v')->value('v'),
            'bajo' => Producto::where('stock', '<=', Producto::STOCK_BAJO)->count(),
            'categorias' => Categoria::withCount('productos')->orderBy('nombre')->get(),
        ]);
    }
}
