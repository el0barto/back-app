<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PuestoController;

Route::apiResource('departamentos', DepartamentoController::class);
Route::apiResource('puestos', PuestoController::class);