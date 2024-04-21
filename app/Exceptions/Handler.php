<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use PHPUnit\TextUI\Configuration\NoCustomCssFileException;
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

    public function report(Throwable $exception)
    {
        if ($exception instanceof NoCustomCssFileException) {
            // Your custom error handling logic here
            trigger_error('Your custom error message', E_USER_NOTICE);
        }

        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        // تحقق مما إذا كان الخطأ ناتجًا عن استثناء في قاعدة البيانات
        if ($exception instanceof QueryException) {
            // تحقق مما إذا كان الخطأ ناتجًا عن محاولة إدخال قيمة مكررة
            if ($exception->errorInfo[1] == 1062) {
                return response()->view('errors.database', ['message' => 'عذرًا، حدثت مشكلة تقنية. يُرجى المحاولة مرة أخرى لاحقًا.'], 500);
            }
        }

        // التعامل مع حالات الاستثناء الأخرى هنا

        return parent::render($request, $exception);
    }
}
