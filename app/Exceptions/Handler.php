<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Exception $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Exception $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return Response
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
     *
     * @throws Exception
     */
    public function render($request, Exception $exception)
    {
        $preparedException = $this->prepareException($exception);

        if ($preparedException instanceof HttpResponseException) {
            return $preparedException->getResponse();
        } elseif ($preparedException instanceof AuthenticationException) {
            return response()->json(['message' => $exception->getMessage()], 401);
        } elseif ($preparedException instanceof ValidationException) {
            if ($preparedException->response) {
                return $preparedException->response;
            }

            return $this->invalidJson($request, $preparedException);
        }

        return $this->prepareJsonResponse($request, $preparedException);
    }
}
