<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\User\CreateUserDto;
use App\Dtos\User\GetUsersDto;
use App\Dtos\User\UpdateUserDto;
use App\Exceptions\ApplicationException;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepo;
use App\Services\Interfaces\IUserService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

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
        $this->saveImage($savedUser->id, $createUserDto->image);
        return $savedUser;
    }

    /**
     * @param GetUsersDto $getUsersDto
     */
    public function getUsers(GetUsersDto $getUsersDto)
    {
        return $this->userRepository->getUsers($getUsersDto);
    }


    /**
     * @param int $id
     * @return User
     */
    private function getUserById(int $id): User|null
    {
        $user = $this->userRepository->getUserById($id);
        if (is_null($user)) {
            throw new ApplicationException(Error::USER_NOT_FOUND->value);
        }
        return  $user;
    }



    public function updateUser(UpdateUserDto $updateUserDto): bool
    {
        $this->getUserById($updateUserDto->id);
        $result = $this->userRepository->updateUser($updateUserDto);
        if (!is_null($updateUserDto->image)) {
            $this->saveImage($updateUserDto->id, $updateUserDto->image);
        }
        return $result;
    }


    public function deleteUser(int $id): bool|null
    {
        $this->getUserById($id);
        return $this->userRepository->deleteUser($id);
    }


    private function saveImage(int $userId, UploadedFile $image)
    {
        //save userimages on server
        $imagePath = Config::get('ecommerce.storage_path') . DIRECTORY_SEPARATOR . $userId;
        $image->storeAs($imagePath, $image->getClientOriginalName());
    }
}
