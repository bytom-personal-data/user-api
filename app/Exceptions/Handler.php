<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param Exception $exception
     * @return mixed|void
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
        if ($exception instanceof NotFoundHttpException) {
            return response([
                'error' => 'true',
                'message' => $exception->getMessage()
            ])->setStatusCode(404);
        }

        if ($exception instanceof AuthorizationException) {
            return response([
                'error' => 'true',
                'message' => $exception->getMessage()
            ])->setStatusCode(401);
        }

        if ($exception instanceof HttpException) {
            return response([
                'error' => 'true',
                'message' => $exception->getMessage(),
            ])->setStatusCode($exception->getStatusCode());
        }

        return response([
            'error' => 'true',
            'message' => $exception->getMessage(),
        ])->setStatusCode(400);

    }
}
