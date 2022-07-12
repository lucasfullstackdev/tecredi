<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::post('/', [CategoriaController::class, 'store']);
    Route::get('/', [CategoriaController::class, 'index']);

    Route::prefix('/export')->group(function () {
        Route::get('/csv', [CategoriaController::class, 'exportEntitiesToCsv']);
        Route::get('/pdf', [CategoriaController::class, 'exportEntitiesToPdf']);
    });
});

Route::prefix('/{id}')->group(function () {
    Route::get('/', [CategoriaController::class, 'show'])->where('id', '[0-9]+');

    Route::put('/', [CategoriaController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/', [CategoriaController::class, 'destroy'])->where('id', '[0-9]+');

    Route::prefix('/export')->group(function () {
        Route::get('/csv', [CategoriaController::class, 'exportEntityToCsv']);
        Route::get('/pdf', [CategoriaController::class, 'exportEntityToPdf']);
    });
});
