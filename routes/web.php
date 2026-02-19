<?php

use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\RedirectController;
use Illuminate\Support\Facades\Route;

Route::resource('home', HomeController::class)->names('urlpanel');
Route::get('/', function () {
    return redirect('home', 301);
});
Route::get('/{short_code}', [RedirectController::class, 'redirect']);