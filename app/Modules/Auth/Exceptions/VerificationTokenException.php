<?php


namespace App\Modules\Auth\Exceptions;


use Exception;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VerificationException
 * @package App\Modules\Auth\Exceptions
 */
class VerificationTokenException extends Exception
{
    /**
     * AuthException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Verification token expired, We sent new token  to your email.", $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
