<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Interfaces\IAuthorizationService;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthorizationService
 * @package App\Services
 */
class AuthorizationService implements IAuthorizationService
{

    /**
     * @param int $role
     * @return bool
     */
    public function isUserAuthorized(int $role): bool
    {
        $authUser =  Auth::user();
        return $authUser && $authUser->role_id === $role;
    }
}
