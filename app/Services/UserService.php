<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\User\CreateUserDto;
use App\Exceptions\ApplicationException;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepo;
use App\Services\Interfaces\IUserService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services
 */
final class UserService implements IUserService
{

    public function __construct(private IUserRepo $userRepository)
    {
    }

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User|null
    {
        return  $this->userRepository->getUserByEmail($email);
    }

    /**
     * @param CreateUserDto $createUserDto
     * @return User
     * @throws ApplicationException
     */
    public function createUser(CreateUserDto $createUserDto): User
    {
        $user = $this->getUserByEmail($createUserDto->email);
        if (!is_null($user)) {
            throw new ApplicationException(Error::EMAIL_ALREADY_EXISTS->value);
        }
        $createUserDto->password = Hash::make($createUserDto->password);

        $savedUser = $this->userRepository->createUser($createUserDto);
        //save userimages on server
        $imagePath = Config::get('ecommerce.storage_path') . DIRECTORY_SEPARATOR . $savedUser->id;
        $image = $createUserDto->image;
        $image->storeAs($imagePath, $image->getClientOriginalName());
        return $savedUser;
    }
}
