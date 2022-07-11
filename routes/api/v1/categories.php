<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::post('/', fn () => dd('insert category'));
    Route::get('/', fn () => dd('list all categories'));

    Route::prefix('/export')->group(function () {
        Route::get('/csv', fn () => dd('export all categories to csv'));
        Route::get('/pdf', fn () => dd('export all categories to pdf'));
    });
});

Route::prefix('/{id}')->group(function () {
    Route::put('/', fn () => dd('update category'))->where('id', '[0-9]+');
    Route::delete('/', fn () => dd('delete category'))->where('id', '[0-9]+');
    Route::get('/', fn () => dd('list specific category'))->where('id', '[0-9]+');

    Route::prefix('/export')->group(function () {
        Route::get('/csv', fn () => dd('export specific category to csv'));
        Route::get('/pdf', fn () => dd('export specific category to pdf'));
    });
});
