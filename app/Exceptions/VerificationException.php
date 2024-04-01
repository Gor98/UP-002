<?php


namespace App\Exceptions;


use Exception;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VerificationException
 * @package App\Exceptions
 */
class VerificationException extends Exception
{
    /**
     * AuthException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "User is not verified.", $code = Response::HTTP_FORBIDDEN, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
