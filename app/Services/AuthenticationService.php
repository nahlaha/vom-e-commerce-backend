<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\User\AuthDto;
use App\Dtos\User\TokenDto;
use App\Exceptions\ApplicationException;
use App\Exceptions\TechnicalException;
use App\Services\Interfaces\IAuthService;
use App\Services\Interfaces\IUserService;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class AuthenticationService
 * @package App\Services
 */
final class AuthenticationService implements IAuthService
{

    public function __construct(private IUserService $userService)
    {
    }


    /**
     * authenticate User
     *
     * @param AuthDto $authUserDto
     * @return string
     * @throws ApplicationException
     */
    public function authenticateUser(AuthDto $authUserDto): TokenDto
    {
        $user = $this->userService->getUserByEmail($authUserDto->email);
        if (!is_null($user) && Hash::check($authUserDto->password, $user->password)) {
            return new TokenDto($this->generateToken($user));
        }
        throw new ApplicationException(Error::INVALID_USERNAME_PASSWORD->value);
    }

    /**
     * @param JWTSubject $model
     * @return string $token
     * @throws TechnicalException
     */
    private function generateToken(JWTSubject $model): string
    {
        try {
            $token = JWTAuth::fromUser($model);
        } catch (JWTException $e) {
            throw new TechnicalException(Error::GENERAL_ERROR->value, $e);
        }
        return $token;
    }
}
