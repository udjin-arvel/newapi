<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Log;

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
	 * @param \Exception $exception
	 * @return void
	 * @throws Exception
	 */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (! ($exception instanceof TBError))  {
	        Log::error('Необработанное исключение: ' . $exception->getMessage());
	        
	        if (!env('APP_DEBUG')) {
	            $exception = new TBError(TBError::SERVER_ERROR);
	        }
        }
	
	    return $exception->render();
    }
}
