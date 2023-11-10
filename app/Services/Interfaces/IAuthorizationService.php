<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

interface IAuthorizationService
{
    public function isUserAuthorized(int $role): bool;
}
