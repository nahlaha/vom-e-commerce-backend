<?php

declare(strict_types=1);

namespace App\Dtos\User;

class AuthDto
{

    public function __construct(public string $email, public string $password)
    {
    }
}
