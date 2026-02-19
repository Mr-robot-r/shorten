<?php

use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\RedirectController;
use Illuminate\Support\Facades\Route;

Route::prefix('home')->group(function () {
    // Route::get('',das)
    Route::resource('', HomeController::class)->names('url');

});

Route::get('/{short_code}', [RedirectController::class, 'redirect']);