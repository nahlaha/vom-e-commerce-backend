<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Constants\Error;

class ValidationException extends BaseException
{
    public function __construct(private array $validations)
    {
        parent::__construct(Error::INVALID_INPUT->value);
    }


    public function getValidationErrors()
    {
        return $this->validations;
    }
}
