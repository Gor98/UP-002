<?php


namespace App\Modules\Auth\Exceptions;


use Exception;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthException
 * @package App\Modules\Auth\Exceptions
 */
class AuthException extends Exception
{
    /**
     * AuthException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Not Authorized.", $code = Response::HTTP_UNAUTHORIZED, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
