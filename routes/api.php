<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register')->withoutMiddleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth:sanctum');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('me', [AuthController::class, 'me'])->name('me');

Route::prefix('users')->group(function () {
    Route::get('/' , [UserController::class, 'index'])->name('users.index');
    Route::post('/' , [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}' , [UserController::class, 'show'])->name('users.show');
    Route::put('/{user}' , [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}' , [UserController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('cars.index')->middleware('auth:sanctum');
    Route::post('/', [CarController::class, 'store'])->name('cars.store');
    Route::get('/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::put('/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});

Route::prefix('carmodels')->group(function () {
    Route::get('/', [CarModelController::class, 'index'])->name('carmodels.index');
    Route::post('/', [CarModelController::class, 'store'])->name('carmodels.store');
    Route::get('/{carModel}', [CarModelController::class, 'show'])->name('carmodels.show');
    Route::put('/{carModel}', [CarModelController::class, 'update'])->name('carmodels.update');
    Route::delete('/{carModel}', [CarModelController::class, 'destroy'])->name('carmodels.destroy');
})->middleware('auth:sanctum');
