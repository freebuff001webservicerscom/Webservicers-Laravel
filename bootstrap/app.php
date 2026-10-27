<?php

use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\MaintenanceMode;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // The hosting preview runs behind a TLS-terminating proxy; trusting its
        // forwarded headers makes asset()/route() generate https:// URLs so
        // stylesheets and scripts are not blocked as mixed content.
        $middleware->trustProxies(at: '*');

        // Auth redirects: guests go to the sign-in screen; signed-in admins
        // land in the workspace and regular customers in their dashboard.
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(function (): string {
            $user = auth()->user();

            return $user !== null ? route($user->homeRoute()) : route('home');
        });

        // Settings → Maintenance mode takes the public site down.
        $middleware->web(append: [MaintenanceMode::class]);

        $middleware->alias([
            'admin' => EnsureAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
