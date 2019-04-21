<?php

namespace Radiophonix\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Radiophonix\Http\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request $request
     * @param  Exception $e
     * @return ApiResponse|Response
     */
    public function render($request, Exception $e)
    {
        if ($request->isJson()
            || $request->wantsJson()
            || $request->isXmlHttpRequest()
            || config('app.debug')
        ) {
            $statusCode = 500;
            $message = $e->getMessage() ?? 'Internal error';
            $errors = false;

            // We try to get a correct status code based on the exception thrown

            if ($e instanceof HttpException) {
                $statusCode = $e->getStatusCode();
            } elseif ($e instanceof JWTException) {
                $statusCode = Response::HTTP_FORBIDDEN;
                $message = 'Token not provided';

                if ($e instanceof TokenExpiredException) {
                    $message = 'Token expired';
                    $statusCode = Response::HTTP_UNAUTHORIZED;
                } elseif ($e instanceof TokenInvalidException) {
                    $message = 'Token invalid';
                    $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                } elseif ($e instanceof TokenBlacklistedException) {
                    $message = 'Token blacklisted';
                    $statusCode = Response::HTTP_UNAUTHORIZED;
                }
            } elseif ($e instanceof ModelNotFoundException) {
                $statusCode = 404;
                $message = 'Model not found';
            } elseif ($e instanceof HttpResponseException) {
                $statusCode = $e->getResponse()->getStatusCode();

                // This exception is triggered when form validation fails
                if ($statusCode == 422) {
                    $message = 'Validation error';
                    $errors = json_decode($e->getResponse()->getContent(), true);
                }
            } elseif ($e instanceof ValidationException) {
                $errors = $e->errors();
                $statusCode = $e->status;
                $message = $e->getMessage();
            }

            $data = [
                'message' => $message,
                'status_code' => $statusCode
            ];

            if (is_array($errors)) {
                $data['errors'] = $errors;
            }

            if (config('app.debug')) {
                $data['trace'] = explode("\n", $e->getTraceAsString());
                $data['class'] = get_class($e);
            }

            return new ApiResponse($data, $statusCode);
        }

        return parent::render($request, $e);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  Request $request
     * @param  AuthenticationException $exception
     * @return Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
