<?php

namespace Radiophonix\Exceptions\FakeId;

use Exception;
use Radiophonix\Exceptions\ExceptionBuilder;

class FakeIdException extends Exception
{
    use ExceptionBuilder;

    public static function invalidConnection($connection)
    {
        return self::makeNewInstance(
            'The fakeId connection `%s` is not configured',
            1504644463,
            [$connection]
        );
    }
}
