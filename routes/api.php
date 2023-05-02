<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\StarController;
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

Route::middleware('api')->group(function () {
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->middleware('auth:api');


    Route::prefix('stars')->group(function () {
        Route::get('/', [StarController::class, "index"]);
        Route::post('create', [StarController::class, "store"]);
        Route::post('edit/{id}', [StarController::class, "update"]);
        Route::delete('{id}', [StarController::class, "destroy"]);
        Route::get('/{id}', [StarController::class, "getStar"]);
    });
});

// allowed to everyone
Route::get('/stars', [StarController::class, "index"]);

