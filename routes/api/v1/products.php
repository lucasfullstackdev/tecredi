<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::post('/', fn () => dd('insert product'));
    Route::get('/', fn () => dd('list all products'));

    Route::prefix('/export')->group(function () {
        Route::get('/csv', fn () => dd('export all products to csv'));
        Route::get('/pdf', fn () => dd('export all products to pdf'));
    });
});

Route::prefix('/{id}')->group(function () {
    Route::put('/', fn () => dd('update product'))->where('id', '[0-9]+');
    Route::delete('/', fn () => dd('delete product'))->where('id', '[0-9]+');
    Route::get('/', fn () => dd('list specific product'))->where('id', '[0-9]+');

    Route::prefix('/export')->group(function () {
        Route::get('/csv', fn () => dd('export specific product to csv'));
        Route::get('/pdf', fn () => dd('export specific product to pdf'));
    });
});
