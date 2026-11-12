<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// Solo para quien NO ha iniciado sesión
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Solo con sesión iniciada (middleware 'auth'); sin sesión -> /login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', PanelController::class)->name('panel');

    Route::get('/productos/exportar', [ProductoController::class, 'exportar'])->name('productos.exportar');
    Route::patch('/productos/{producto}/stock', [ProductoController::class, 'ajustarStock'])->name('productos.stock');
    Route::resource('productos', ProductoController::class);

    Route::resource('categorias', CategoriaController::class)->only(['create', 'store']);
});
