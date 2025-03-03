<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\GuestUserMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: [
            __DIR__.'/../routes/api.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function() {
            Route::middleware('api')
            ->prefix('api/v2')
            ->group(__DIR__.'/../routes/api_v2.php');
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api', [
            // 'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'auth/login' // <-- exclude this route
        ]);
        // $middleware->alias([
        //     'users' => UserMiddleware::class,
        //     'guestUser' => GuestUserMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function (Request $request) {
        //     if($request->is('api/*')) {
        //         return respone()->json([
        //             'status' => 'error',
        //             'message' => 'error',
        //             'errors' => $exceptions
        //         ]);
        //         return 'login_v2';
        //     }
        // });
    })->create();
