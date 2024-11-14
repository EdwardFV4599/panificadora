<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ComprasinsumoController;
use App\Http\Controllers\ElaboracionproductoController;
use App\Http\Controllers\VentasproductoController;


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
    'can:mantener-insumos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/insumos', [InsumoController::class, 'index'])->name('insumos.index');
    Route::get('/insumos/crear', [InsumoController::class, 'create'])->name('insumos.create');
    Route::post('/insumos/guardar', [InsumoController::class, 'store'])->name('insumos.store');
    Route::get('/insumos/editar/{id}', [InsumoController::class, 'edit'])->name('insumos.edit');
    Route::post('/insumos/actualizar/{id}', [InsumoController::class, 'update'])->name('insumos.update');
    Route::post('/insumos/eliminar/{id}', [InsumoController::class, 'destroy'])->name('insumos.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:mantener-categorias', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/crear', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/guardar', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/editar/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::post('/categorias/actualizar/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::post('/categorias/eliminar/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:mantener-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/guardar', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::post('/productos/actualizar/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::post('/productos/eliminar/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:mantener-proveedores', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/crear', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores/guardar', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/editar/{id}', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::post('/proveedores/actualizar/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::post('/proveedores/eliminar/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:controlar-compras-insumos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/comprasinsumos', [ComprasinsumoController::class, 'index'])->name('comprasinsumos.index');
    Route::get('/comprasinsumos/crear', [ComprasinsumoController::class, 'create'])->name('comprasinsumos.create');
    Route::post('/comprasinsumos/guardar', [ComprasinsumoController::class, 'store'])->name('comprasinsumos.store');
    Route::get('/comprasinsumos/editar/{id}', [ComprasinsumoController::class, 'edit'])->name('comprasinsumos.edit');
    Route::post('/comprasinsumos/actualizar/{id}', [ComprasinsumoController::class, 'update'])->name('comprasinsumos.update');
    Route::post('/comprasinsumos/eliminar/{id}', [ComprasinsumoController::class, 'destroy'])->name('comprasinsumos.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:controlar-elaboracion-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/elaboracionproductos', [ElaboracionproductoController::class, 'index'])->name('elaboracionproductos.index');
    Route::get('/elaboracionproductos/crear', [ElaboracionproductoController::class, 'create'])->name('elaboracionproductos.create');
    Route::post('/elaboracionproductos/guardar', [ElaboracionproductoController::class, 'store'])->name('elaboracionproductos.store');
    Route::get('/elaboracionproductos/editar/{id}', [ElaboracionproductoController::class, 'edit'])->name('elaboracionproductos.edit');
    Route::post('/elaboracionproductos/actualizar/{id}', [ElaboracionproductoController::class, 'update'])->name('elaboracionproductos.update');
    Route::post('/elaboracionproductos/eliminar/{id}', [ElaboracionproductoController::class, 'destroy'])->name('elaboracionproductos.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:controlar-ventas-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/ventasproductos', [VentasproductoController::class, 'index'])->name('ventasproductos.index');
    Route::get('/ventasproductos/crear', [VentasproductoController::class, 'create'])->name('ventasproductos.create');
    Route::post('/ventasproductos/guardar', [VentasproductoController::class, 'store'])->name('ventasproductos.store');
    Route::get('/ventasproductos/editar/{id}', [VentasproductoController::class, 'edit'])->name('ventasproductos.edit');
    Route::post('/ventasproductos/actualizar/{id}', [VentasproductoController::class, 'update'])->name('ventasproductos.update');
    Route::post('/ventasproductos/eliminar/{id}', [VentasproductoController::class, 'destroy'])->name('ventasproductos.destroy');
});


Route::get('obtener-datos-ventas', [VentasproductoController::class, 'obtenerDatosVentas']);
Route::get('exportar-ventas', [VentasproductoController::class, 'exportarVentasCsv'])->name('exportarCSV');
Route::get('ventas/reporte-pdf', [VentasproductoController::class, 'generarReportePdf'])->name('ventas.reportePdf');
Route::get('/ventas-chart', [VentasproductoController::class, 'showVentasChart'])->name('vergrafica');


