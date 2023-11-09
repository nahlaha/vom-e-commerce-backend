<?php

declare(strict_types=1);

namespace App\Exceptions;

class TechnicalException extends BaseException
{
    public function __construct(int $code, $previous = null)
    {
        parent::__construct($code, $previous);
    }
}
