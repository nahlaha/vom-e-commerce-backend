<?php

declare(strict_types=1);

namespace App\Exceptions;

class ApplicationException extends BaseException
{
    public function __construct(int $code)
    {
        parent::__construct($code);
    }
}
