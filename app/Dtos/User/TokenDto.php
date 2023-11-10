<?php

declare(strict_types=1);

namespace App\Dtos\User;

class TokenDto
{

    public function __construct(public string $accessToken)
    {
    }
}
