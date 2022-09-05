<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class Handler
 * @package App\Exceptions
 */
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
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|\Illuminate\Http\Response|Response
     * @throws Throwable
     * @throws ValidationErrorException
     */
    public function render($request, Throwable $e): \Illuminate\Http\Response|JsonResponse|Response
    {
        if ($e instanceof ValidationException) {
            throw new ValidationErrorException(json_encode($e->errors()));
        }

        return parent::render($request, $e);
    }
}
