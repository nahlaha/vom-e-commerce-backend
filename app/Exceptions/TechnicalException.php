<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Constants\Error;

class TechnicalException extends BaseException
{
    public function __construct(?int $code, $previous = null)
    {
        $errorCode = !is_null($code) ? $code : Error::GENERAL_ERROR->value;
        parent::__construct($errorCode, $previous);
    }
}
