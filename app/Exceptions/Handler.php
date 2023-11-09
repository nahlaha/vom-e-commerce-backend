<?php

namespace App\Exceptions;

use App\Constants\Error;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use App\Services\ResponseService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Exceptions\TechnicalException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
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
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     *
     * @param $request
     * @param Throwable $exception
     * @return \App\Services\Illuminate\Http\Response
     * @throws Exception
     */
    public function render($request, Throwable $exception)
    {
        $previous = $exception->getPrevious();
        $responseService = new ResponseService();
        if ($exception instanceof ValidationException) {
            return $responseService->getErrorResponse($exception->getCode(), $exception->getValidationErrors());
        }
        if ($exception instanceof BaseException) {
            return $responseService->getErrorResponse($exception->getCode());
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            throw new ApplicationException(Error::METHOD_NOT_ALLOWED->value);
        }
        if ($exception instanceof NotFoundHttpException) {
            throw new ApplicationException(Error::ROUTE_NOT_FOUND->value);
        }
        if ($exception instanceof UnauthorizedHttpException && $previous instanceof TokenExpiredException) {
            throw new AuthException(Error::TOKEN_EXPIRED->value);
        }
        if ($exception instanceof UnauthorizedHttpException && $previous instanceof TokenInvalidException) {
            throw new AuthException(Error::TOKEN_INVALID->value);
        }
        if ($exception instanceof UnauthorizedHttpException) {
            throw new AuthException(Error::TOKEN_NOT_PROVIDED->value);
        }
        throw new TechnicalException(Error::UNKNOWN_ERROR->value, $exception);
    }
}
