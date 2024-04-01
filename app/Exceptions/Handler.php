<?php

namespace App\Exceptions;

use App\Common\Tools\APIResponse;
use App\Modules\Auth\Exceptions\AuthException;
use App\Modules\Auth\Exceptions\VerificationTokenException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Class Handler
 * @package App\Exceptions
 */
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

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        return $this->customApiResponse($exception);
    }

    /**
     * @param Throwable $exception
     * @return JsonResponse
     */
    private function customApiResponse(Throwable $exception): JsonResponse
    {
        $exceptionName = get_class($exception);

        switch ($exceptionName) {
            case ValidationException::class:
                $response['message'] = trans("errors.".getClassName($exception));
                $response['errors'] = $exception->errors();
                $response['status'] = Response::HTTP_UNPROCESSABLE_ENTITY;
                break;
            case VerificationTokenException::class:
                $response['message'] = $exception->getMessage();
                $response['status'] = Response::HTTP_BAD_REQUEST;
                break;
            case UnauthorizedException::class:
            case VerificationException::class:
                $response['message'] = trans("errors.".getClassName($exception));
                $response['status'] = Response::HTTP_FORBIDDEN;
                break;
            case AuthenticationException::class:
                $response['message'] = trans("errors.".getClassName($exception));
                $response['status'] = Response::HTTP_UNAUTHORIZED;
                break;
            case ModelNotFoundException::class:
            case NotFoundHttpException::class:
                $response['message'] = trans("errors.".getClassName($exception));
                $response['status'] = Response::HTTP_NOT_FOUND;
                break;
            case MethodNotAllowedHttpException::class:
                $response['message'] = trans("errors.".getClassName($exception));
                $response['status'] = Response::HTTP_METHOD_NOT_ALLOWED;
                break;
            case ClientException::class:
            case AuthException::class:
                $response['message'] = trans("errors.".getClassName($exception));
                $response['status'] = $exception->getCode();
                break;
            default:
                $response['message'] =  trans("errors.default");
                $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
        }

        if (config('app.debug')) {
            $response['message'] = empty($exception->getMessage()) ? $response['message'] : $exception->getMessage() ;
        }

        return APIResponse::errorResponse($response, 'Error request.', $response['status']);
    }
}
