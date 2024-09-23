<?php

use Illuminate\Support\Facades\Route;

// Nuevo
use App\Http\Controllers\RolePermissionController;


Route::get('/', function () {
    return view('/auth/login');
});

// Middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:view-dashboard', // Verifica que el usuario tenga el permiso 'view-dashboard'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('/modulos/dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:view-dashboard', // Verifica que el usuario tenga el permiso 'view-dashboard'
])->group(function () {
    Route::get('/gestionar-usuarios', function () {
        return view('gestionar-usuarios');
    })->name('gestionar-usuarios');
});

Route::middleware([
    'auth:sanctum', 
    config('jetstream.auth_session'),
    'verified',
    'can:manage-users', // Verifica que el usuario tenga el permiso 'manage-users'
])->group(function () {
    Route::get('/gestionar-usuarios', [RolePermissionController::class, 'index'])->name('gestionar-usuarios');
    Route::post('/gestionar-usuarios/assign-role/{user}', [RolePermissionController::class, 'assignRole'])->name('assign.role');
    Route::delete('/gestionar-usuarios/remove-role/{user}/{role}', [RolePermissionController::class, 'removeRole'])->name('remove.role');
    Route::post('/gestionar-usuarios/assign-permission/{user}', [RolePermissionController::class, 'assignPermission'])->name('assign.permission');
    Route::delete('/gestionar-usuarios/remove-permission/{user}/{permission}', [RolePermissionController::class, 'removePermission'])->name('remove.permission');
});
