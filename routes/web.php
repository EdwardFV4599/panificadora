<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ComprainsumoController;
use App\Http\Controllers\ElaboracionproductoController;
use App\Http\Controllers\VentaproductoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\PrediccionController;
use App\Http\Controllers\AyudaController;
use App\Http\Controllers\TiemposController;

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
    Route::get('/comprasinsumos', [ComprainsumoController::class, 'index'])->name('comprasinsumos.index');
    Route::get('/comprasinsumos/crear', [ComprainsumoController::class, 'create'])->name('comprasinsumos.create');
    Route::post('/comprasinsumos/guardar', [ComprainsumoController::class, 'store'])->name('comprasinsumos.store');
    Route::get('/comprasinsumos/editar/{id}', [ComprainsumoController::class, 'edit'])->name('comprasinsumos.edit');
    Route::post('/comprasinsumos/actualizar/{id}', [ComprainsumoController::class, 'update'])->name('comprasinsumos.update');
    Route::post('/comprasinsumos/eliminar/{id}', [ComprainsumoController::class, 'destroy'])->name('comprasinsumos.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:controlar-elaboracion-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/elaboracionproductos', [ElaboracionproductoController::class, 'index'])->name('elaboracionproductos.index');
    Route::get('/elaboracionproductos/{id}', [ElaboracionproductoController::class, 'show'])->name('elaboracionproductos.show');
    Route::get('/elaboracionproductos/create/{id}', [ElaboracionproductoController::class, 'create'])->name('elaboracionproductos.create');
    Route::post('/elaboracionproductos/{id}', [ElaboracionproductoController::class, 'store'])->name('elaboracionproductos.store');
    Route::post('/elaboracionproductos/cancelar/{id}', [ElaboracionproductoController::class, 'cancelar'])->name('elaboracionproductos.cancelar');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:controlar-ventas-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/ventasproductos', [VentaproductoController::class, 'index'])->name('ventasproductos.index');
    Route::get('/ventasproductos/crear', [VentaproductoController::class, 'create'])->name('ventasproductos.create');
    Route::post('/ventasproductos/guardar', [VentaproductoController::class, 'store'])->name('ventasproductos.store');
    Route::get('/ventasproductos/editar/{id}', [VentaproductoController::class, 'edit'])->name('ventasproductos.edit');
    Route::post('/ventasproductos/actualizar/{id}', [VentaproductoController::class, 'update'])->name('ventasproductos.update');
    Route::post('/ventasproductos/eliminar/{id}', [VentaproductoController::class, 'destroy'])->name('ventasproductos.destroy');
});

// Factura
Route::get('/exportar-ventas', [FacturaController::class, 'exportarVentasCsv'])->name('exportarCSV');
Route::get('/factura/{ventaId}', [FacturaController::class, 'mostrarFactura'])->name('factura.mostrar');
Route::get('/factura/descargar/{ventaId}', [FacturaController::class, 'descargarFactura'])->name('factura.descargar');

// Graficos
Route::get('/graficos', [GraficoController::class, 'mostrarGraficos'])->name('graficos.index');
Route::get('/graficas/ventas', [GraficoController::class, 'obtenerVentas'])->name('graficos.ventas');

// Reportes
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::post('/reportes/generar', [ReporteController::class, 'generarReporte'])->name('reportes.generar');

// Ayuda en línea
Route::get('/ayuda', [AyudaController::class, 'index'])->name('ayuda.index');

// Predicción
Route::get('/prediccion', [PrediccionController::class, 'index'])->name('prediccion.index');

// Tiempos
Route::get('/tiempos', [TiemposController::class, 'index'])->name('tiempos.index');
Route::get('/tiempos/export/excel', [TiemposController::class, 'exportExcel'])->name('tiempos.exportExcel');
Route::get('/tiempos/export/pdf', [TiemposController::class, 'exportPdf'])->name('tiempos.exportPdf');
