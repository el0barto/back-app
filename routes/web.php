<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PuestoController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// Rutas API con prefijo /api
Route::prefix('api')->group(function () {
    Route::apiResource('departamentos', DepartamentoController::class);
    Route::apiResource('puestos', PuestoController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';