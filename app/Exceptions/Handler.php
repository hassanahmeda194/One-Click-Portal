<?php

namespace App\Exceptions;

use App\Models\ErrorLog;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
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

    public function render($request, $e): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();

            if (view()->exists("errors.$statusCode")) {
                return response()->view("errors.$statusCode", [], $statusCode);
            }
        }

        // Handling duplicate entry exception
        if ($e instanceof QueryException && $e->getCode() === 23000 && str_contains($e->getMessage(), 'Duplicate entry')) {
            return response()->json(['error' => 'This email is already registered. Please use a different email address.'], 400);
        }

        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $e): void
    {
        if ($this->shouldReport($e)) {
            // Log the exception message and additional information
            Log::error('Exception reported: ' . $e->getMessage(), [
                'exception' => $e,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Log the exception to the database
            $this->logToDatabase($e);
        }

        parent::report($e);
    }

    protected function logToDatabase(Throwable $e): void
    {
        $log = new ErrorLog();
        $log->message = $e->getMessage();
        $log->file = $e->getFile();
        $log->line = $e->getLine();
        $log->trace = $e->getTraceAsString();
        $log->save();
    }
}
