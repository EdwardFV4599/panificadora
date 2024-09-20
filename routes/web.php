<?php

use Illuminate\Support\Facades\Route;
// Nuevo
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
