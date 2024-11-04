<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\ElaboracionController;


// Rutas
Route::get('/', function () {
    return view('/auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:ver-home', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/dashboard', function () {
        return view('/dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:mantener-materias-primas', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/materia_primas', [MateriaPrimaController::class, 'index'])->name('materia_primas.index');
    Route::get('/materia_primas_crear', [MateriaPrimaController::class, 'create'])->name('materia_primas.create');
    Route::post('/materia_primas_guardar', [MateriaPrimaController::class, 'store'])->name('materia_primas.store');
    Route::get('/materia_primas_editar/{id}', [MateriaPrimaController::class, 'edit'])->name('materia_primas.edit');
    Route::post('/materia_primas_actualizar/{id}', [MateriaPrimaController::class, 'update'])->name('materia_primas.update');
    Route::post('/materia_primas_eliminar/{id}', [MateriaPrimaController::class, 'destroy'])->name('materia_primas.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:mantener-categorias', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias_crear', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias_guardar', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias_editar/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::post('/categorias_actualizar/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::post('/categorias_eliminar/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:mantener-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos_crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos_guardar', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos_editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::post('/productos_actualizar/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::post('/productos_eliminar/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:mantener-proveedores', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores_crear', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores_guardar', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores_editar/{id}', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::post('/proveedores_actualizar/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::post('/proveedores_eliminar/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:controlar-entradas-materias-primas', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
    Route::get('/entradas_crear', [EntradaController::class, 'create'])->name('entradas.create');
    Route::post('/entradas_guardar', [EntradaController::class, 'store'])->name('entradas.store');
    Route::get('/entradas_editar/{id}', [EntradaController::class, 'edit'])->name('entradas.edit');
    Route::post('/entradas_actualizar/{id}', [EntradaController::class, 'update'])->name('entradas.update');
    Route::post('/entradas_eliminar/{id}', [EntradaController::class, 'destroy'])->name('entradas.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:controlar-elaboracion-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/elaboraciones', [ElaboracionController::class, 'index'])->name('elaboraciones.index');
    Route::get('/elaboraciones_crear', [ElaboracionController::class, 'create'])->name('elaboraciones.create');
    Route::post('/elaboraciones_guardar', [ElaboracionController::class, 'store'])->name('elaboraciones.store');
    Route::get('/elaboraciones_editar/{id}', [ElaboracionController::class, 'edit'])->name('elaboraciones.edit');
    Route::post('/elaboraciones_actualizar/{id}', [ElaboracionController::class, 'update'])->name('elaboraciones.update');
    Route::post('/elaboraciones_eliminar/{id}', [ElaboracionController::class, 'destroy'])->name('elaboraciones.destroy');
});





