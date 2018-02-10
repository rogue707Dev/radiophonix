<?php

namespace Radiophonix\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidationHttpException extends HttpException
{
    /**
     * ValidationHttpException constructor.
     * @param null $message
     * @param Exception $previous
     * @param int $code
     */
    public function __construct($message = null, Exception $previous = null, $code = 0)
    {
        parent::__construct(422, $message, $previous, [], $code);
    }
}
