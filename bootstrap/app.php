<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\NotificationMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'guest' => GuestMiddleware::class,
            'authenticate' => AuthenticateMiddleware::class,
            'admin' => AdminMiddleware::class

        ]);
        $middleware->web(append: [
            HandleInertiaRequests::class,
            NotificationMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
