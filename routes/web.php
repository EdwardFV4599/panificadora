<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\ProductoController;


// Rutas
Route::get('/', function () {
    return view('/auth/login');
});


// Middleware
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
    'can:gestionar-materias-primas', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::resource('materia_primas', MateriaPrimaController::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:gestionar-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::resource('productos', ProductoController::class);
});






































// No se usa por ahora

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:gestionar-usuarios', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::get('/gestionar-usuarios', function () {
        return view('gestionar-usuarios');
    })->name('gestionar-usuarios');
});


Route::middleware([
    'auth:sanctum', 
    config('jetstream.auth_session'),
    'verified',
    'can:manage-users', 
])->group(function () {
    Route::get('/gestionar-usuarios', [RolePermissionController::class, 'index'])->name('gestionar-usuarios');
    Route::post('/gestionar-usuarios/assign-role/{user}', [RolePermissionController::class, 'assignRole'])->name('assign.role');
    Route::delete('/gestionar-usuarios/remove-role/{user}/{role}', [RolePermissionController::class, 'removeRole'])->name('remove.role');
    Route::post('/gestionar-usuarios/assign-permission/{user}', [RolePermissionController::class, 'assignPermission'])->name('assign.permission');
    Route::delete('/gestionar-usuarios/remove-permission/{user}/{permission}', [RolePermissionController::class, 'removePermission'])->name('remove.permission');
});
