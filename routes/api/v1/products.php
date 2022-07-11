<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/', [ProdutoController::class, 'index']);
    Route::post('/', [ProdutoController::class, 'store']);

    Route::prefix('/export')->group(function () {
        Route::get('/csv', fn () => dd('export all products to csv'));
        Route::get('/pdf', fn () => dd('export all products to pdf'));
    });
});

Route::prefix('/{id}')->group(function () {
    Route::get('/', [ProdutoController::class, 'show'])->where('id', '[0-9]+');

    Route::put('/', [ProdutoController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/', [ProdutoController::class, 'destroy'])->where('id', '[0-9]+');

    Route::prefix('/export')->group(function () {
        Route::get('/csv', fn () => dd('export specific product to csv'));
        Route::get('/pdf', fn () => dd('export specific product to pdf'));
    });
});
