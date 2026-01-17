<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckMaintenanceMode;
use App\Http\Middleware\TrackAnalytics;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'maintenance' => CheckMaintenanceMode::class,
            'analytics' => TrackAnalytics::class,
        ]);

        $middleware->web(append: [
            CheckMaintenanceMode::class,
            TrackAnalytics::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
