<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Dtos\User\AuthDto;
use App\Dtos\User\TokenDto;

interface IAuthService
{
    public function authenticateUser(AuthDto $authUserDto): TokenDto;
}
