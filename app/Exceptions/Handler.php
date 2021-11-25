<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        //parent::report($exception);

    if ($this->shouldntReport($exception)) {
        return;
    }

    // Remove stack-trace when not debugging.
    if (!config('app.debug')) {
        Log::error(
            sprintf(
                "\n\r%s: %s in %s:%d\n\r",
                get_class($exception),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine()
            )
        );
        // 'trace' => $exception->getTraceAsString(),
    }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //if (!config('app.debug')) {
          //  error_reporting(0);
    
            return response('Ooops, somethis is going wrong', 500);
        //}
        //..return parent::render($request, $exception);
    }
}
