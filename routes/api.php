<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/v1')->group(function () {
    Route::prefix('/products')->group(realpath(__DIR__ . '/api/v1/products.php'));
    Route::prefix('/categories')->group(realpath(__DIR__ . '/api/v1/categories.php'));
});
