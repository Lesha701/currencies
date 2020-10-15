<?php

namespace App\Exceptions;

use App\Response\ErrorResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return ErrorResponse|Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return new ErrorResponse('User not authenticated', 401);
    }

    /**
     * @param Request $request
     * @param Throwable $e
     * @return ErrorResponse|JsonResponse|\Illuminate\Http\Response|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return new ErrorResponse('Resource not found', 404);
        }

        return parent::render($request, $e);
    }
}
