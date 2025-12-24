<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
         
            // \App\Http\Middleware\RoleMiddleware::class, //a ne pas de commenter ca rendrait le midelware role globale et appliquer automatiquement a tous les routes
        ]);

        // $middleware->api(append: [
        //     'cors',
        //     SubstituteBindings::class,
        // ]);
        

        $middleware->alias([
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
