<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        return view('productos.index', [
            'productos' => Producto::with('categoria')->filtrar($request->only('q', 'categoria', 'bajo'))->orderBy('nombre')->get(),
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

    public function create()
    {
        return view('productos.create', ['categorias' => Categoria::orderBy('nombre')->get()]);
    }

    public function store(ProductoRequest $request) // ProductoRequest valida antes de entrar
    {
        Producto::create($request->validated());

        return redirect()->route('productos.index')->with('ok', 'Producto creado.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', ['producto' => $producto->load('categoria')]);
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', ['producto' => $producto, 'categorias' => Categoria::orderBy('nombre')->get()]);
    }

    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        return redirect()->route('productos.index')->with('ok', 'Producto actualizado.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('ok', 'Producto eliminado.');
    }

    public function ajustarStock(Request $request, Producto $producto)
    {
        $datos = $request->validate(['cantidad' => 'required|integer'], [
            'cantidad.required' => 'Indica una cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
        ]);
        $nuevo = $producto->stock + $datos['cantidad'];

        if ($nuevo < 0) {
            return back()->with('error', "Stock insuficiente: {$producto->nombre} solo tiene {$producto->stock}.");
        }
        $producto->update(['stock' => $nuevo]);

        return back()->with('ok', "Stock de {$producto->nombre}: {$nuevo}.");
    }

    public function exportar(Request $request)
    {
        $productos = Producto::with('categoria')->filtrar($request->only('q', 'categoria', 'bajo'))->orderBy('nombre')->get();

        return response()->streamDownload(function () use ($productos) {
            $f = fopen('php://output', 'w');
            fwrite($f, "\xEF\xBB\xBF"); // para que Excel respete los acentos
            fputcsv($f, ['Nombre', 'Categoría', 'Precio', 'Stock'], ',', '"', '');
            foreach ($productos as $p) {
                fputcsv($f, [$p->nombre, $p->categoria->nombre, $p->precio, $p->stock], ',', '"', '');
            }
            fclose($f);
        }, 'productos.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
