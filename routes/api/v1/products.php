<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/', [ProdutoController::class, 'index']);
    Route::post('/', [ProdutoController::class, 'store']);

    Route::prefix('/export')->group(function () {
        Route::get('/csv', [ProdutoController::class, 'exportProdutosToCsv']);
        Route::get('/pdf', [ProdutoController::class, 'exportProdutosToPdf']);
    });
});

Route::prefix('/{id}')->group(function () {
    Route::get('/', [ProdutoController::class, 'show'])->where('id', '[0-9]+');

    Route::put('/', [ProdutoController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/', [ProdutoController::class, 'destroy'])->where('id', '[0-9]+');

    Route::prefix('/export')->group(function () {
        Route::get('/csv', [ProdutoController::class, 'exportProdutoToCsv']);
        Route::get('/pdf', [ProdutoController::class, 'exportProdutoToPdf']);
    });
});
