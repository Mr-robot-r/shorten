<?php

namespace App\Providers;

use App\Exceptions\Handler;
use Illuminate\Support\ServiceProvider;
use NunoMaduro\Collision\Adapters\Laravel\ExceptionHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ExceptionHandler::class, Handler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
