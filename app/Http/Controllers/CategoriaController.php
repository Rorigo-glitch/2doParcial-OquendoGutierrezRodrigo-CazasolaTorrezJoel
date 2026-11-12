<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate(
            ['nombre' => 'required|string|max:60|unique:categorias,nombre'],
            ['nombre.required' => 'El nombre es obligatorio.', 'nombre.unique' => 'Esa categoría ya existe.'],
        );
        Categoria::create($datos);

        return redirect()->route('productos.index')->with('ok', 'Categoría creada.');
    }
}
