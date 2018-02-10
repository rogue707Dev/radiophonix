<?php

namespace Radiophonix\Exceptions;

use Radiophonix\Http\Transformers\Support\Transformer;

class TransformerException
{
    use ExceptionBuilder;

    /**
     * @param string $className
     * @return static
     */
    public static function classDoesNotExist(string $className)
    {
        return self::makeNewInstance(
            'The transformer class %s does not exist',
            1503857102,
            [$className]
        );
    }

    /**
     * @param string $className
     * @return static
     */
    public static function transformerDoesNotExtendCorrectClass(string $className)
    {
        return self::makeNewInstance(
            'The transformer class %s must extend %s',
            1503857154,
            [$className, Transformer::class]
        );
    }
}
