<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        // Check if the exception is an HTTP exception
        if ($this->isHttpException($e)) {
            $statusCode = $e->getStatusCode();

            // Handle 404 error
            if ($statusCode == 404) {
                return response()->view('error.404', [], 404);
            }

            // Handle 500 Internal Server Error
            if ($statusCode == 500||$statusCode == 403) {
                return response()->view('error.500', [], 500);
            }
        }

        if (strpos($e->getMessage(), 'curl')) {
            return response()->view('error.500', [], 500);
        }

        // Default error handling for other exceptions
        return parent::render($request, $e);
    }
}
