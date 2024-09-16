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

    public function render($request, Throwable $exception)
    {
        // Check if the exception is an HTTP exception (e.g., 404, 403, etc.)
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            if($statusCode = 404){
                return response()->view('error.404'); // Render custom 500 page
            }
            return response()->view('error.customError'); // Render custom 500 page
        }

        // Handle 500 (Internal Server Error) or other non-HTTP exceptions
        if (config('app.debug') === false) {
            return response()->view('error.customError'); // Render custom 500 page
        }

        // Default error handling for other exceptions
        return parent::render($request, $exception);
    }
}
