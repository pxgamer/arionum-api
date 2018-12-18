<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     * @return JsonResponse
     */
    public function render($request, Exception $exception): JsonResponse
    {
        $parentRender = parent::render($request, $exception);

        if ($parentRender instanceof JsonResponse) {
            return $parentRender;
        }

        return new JsonResponse([
            'status' => $exception instanceof HttpException ? $exception->getStatusCode() : 500,
            'message' => $exception instanceof HttpException && $exception->getMessage() !== '' ?
                $exception->getMessage() :
                'Server Error',
        ], $parentRender->status());
    }
}
