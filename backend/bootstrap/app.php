<?php

use App\Enums\ResponseStatus;
use App\Http\Middleware\ConvertToSnakeCaseMiddleware;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->append(ConvertToSnakeCaseMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions
            ->render(function (AuthenticationException $e, Request $request) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'status' => ResponseStatus::UNAUTHENTICATED,
                        'message' => 'Unauthenticated',
                        'data' => null
                    ], Response::HTTP_UNAUTHORIZED);
                }
            })
            ->render(function (\Illuminate\Validation\ValidationException $e, Request $request) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'status' => ResponseStatus::FORM_INVALID,
                        'message' => 'Form invalid',
                        'data' => $e->validator->errors()->all()
                    ], Response::HTTP_BAD_REQUEST);
                }

            })
        ;
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => ResponseStatus::UNAUTHENTICATED,
                    'message' => 'Unauthenticated',
                    'data' => null
                ], Response::HTTP_UNAUTHORIZED);
            }

        });
    })->create();
