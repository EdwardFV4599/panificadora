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
    'can:gestionar-productos', // Verifica que el usuario tenga el permiso
])->group(function () {
    Route::resource('productos', ProductoController::class);
});






































// No se usa por ahora
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
