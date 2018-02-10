<?php

namespace Radiophonix\Exceptions;

trait ExceptionBuilder
{
    /**
     * @param string $message
     * @param int $code
     * @param array $arguments
     * @return static
     */
    protected static function makeNewInstance(string $message, int $code, array $arguments = [])
    {
        return new static(vsprintf($message, $arguments), $code);
    }
}
