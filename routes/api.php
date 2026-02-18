<?php


use App\Http\Controllers\Api\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::apiResource('url', UrlController::class)
        ->only(['index', 'store', 'show', 'destroy']);
});