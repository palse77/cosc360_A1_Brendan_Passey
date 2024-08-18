<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register the 'admin' middleware
        Route::aliasMiddleware('admin', AdminMiddleware::class);
    }
}
