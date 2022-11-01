<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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


    // not the default code. I put to use for redirect to page from Gate in authorization 
   /*  public function render($request, Exception $exception)
    {    \
        if ($exception instanceof AuthorizationException) {
         if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            } 
            // TODO: Redirect to error page instead
            // Redirect user from here whatever the route you want.
            return redirect()->route('login');
        }
        // this will still show the error if there is any in your code.
        return parent::render($request, $exception); 
    }
 */
}
