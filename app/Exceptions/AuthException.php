<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Constants\Error;

class AuthException extends BaseException
{
    public function __construct(?int $code = null)
    {
        $errorCode = !is_null($code) ? $code : Error::UNAUTHORIZED->value;
        parent::__construct($errorCode);
    }
}
