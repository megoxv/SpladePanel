<?php

namespace App\Exceptions;

use App\Helpers\MainHelper;
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
        $this->renderable(\ProtoneMedia\Splade\SpladeCore::exceptionHandler($this));

        $this->reportable(function (Throwable $e) {
            MainHelper::make_error_report([
                'error'=>$e->getMessage(),
                'error_code'=>500,
                'details'=>"Error : ".$e->getFile()." Line : ". $e->getLine() . json_encode(request()->instance())
            ]);
        });
    }
}
