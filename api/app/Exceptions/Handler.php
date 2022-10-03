<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @param $request
     * @param  Throwable  $e
     *
     * @return JsonResponse
     */
    public function render($request, Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            /** @var ValidationException $exception */
            $errors = [];
            foreach ($e->errors() as $key => $error) {
                Collection::make($error)->each(function (string $message) use ($key, &$errors) {
                    $errors[] = [
                        'detail' => $message,
                        'source' => $key
                    ];
                });
            }

            return (new JsonResponse(
                [
                    'message' => $e->getMessage() ?? 'Validation exception',
                    'errors' => $errors
                ],
                ResponseAlias::HTTP_UNPROCESSABLE_ENTITY
            ));
        }

        if ($e instanceof UnprocessableEntityHttpException) {
            /** @var NotFoundHttpException $e */
            return new JsonResponse([
                'status' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $e->getMessage() ?? 'Wrong data',
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            /** @var NotFoundHttpException $e */
            return new JsonResponse([
                'status' => ResponseAlias::HTTP_NOT_FOUND,
                'message' => $e->getMessage() ?? 'Resource not found',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        if ($e instanceof UnauthorizedException) {
            return new JsonResponse([
                'status' => ResponseAlias::HTTP_UNAUTHORIZED,
                'message' => $e->getMessage() ?: 'Unauthorized',
            ], ResponseAlias::HTTP_UNAUTHORIZED);
        }

        if (config('app.env') === 'production') {
            $data = [
                'message' => $e->getMessage() === 'Unauthenticated.'
                    ? 'Unauthenticated.'
                    : 'Server Error'
            ];
        } else {
            $data = [
                'message' => $e->getMessage(),
//                Uncomment this if you need the exception details
//                'trace' => $e->getTrace()
            ];
        }

        $code = $e->getCode() > 0 ? $e->getCode() : ResponseAlias::HTTP_BAD_REQUEST;
        return new JsonResponse(
            $data,
            $data['message'] === 'Unauthenticated.'
                ? ResponseAlias::HTTP_UNAUTHORIZED
                : $code
        );
    }
}
