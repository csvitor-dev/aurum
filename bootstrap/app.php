<?php

use App\Exceptions\Internal\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ValidationException $e) {
            return response()->json([
                'message' => 'error on validation',
                'errors' => $e->errors(),
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->renderable(function (ModelNotFoundException $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        });
    })->create();
