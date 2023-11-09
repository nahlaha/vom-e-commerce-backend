<?php

namespace App\Exceptions;

use Exception;
use App\Constants\Error;

class BaseException extends Exception
{

    public function __construct(int $code, $previous = null)
    {
        $this->code = $code;
        parent::__construct($this->message, $this->code, $previous);
    }

}
