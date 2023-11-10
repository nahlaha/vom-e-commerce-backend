<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\User\CreateUserDto;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepo;

/**
 * Class UserRepository
 * @package App\Repositories
 */
final class UserRepository implements IUserRepo
{

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User|null
    {
        return User::where('email', $email)->first();
    }

    /**
     * Creates a new user
     * @param CreateUserDto $createUserDto
     * @return User
     */
    public function createUser(CreateUserDto $createUserDto): User
    {
        $user = new User();
        $user->first_name = $createUserDto->firstName;
        $user->last_name = $createUserDto->lastName;
        $user->email = $createUserDto->email;
        $user->password = $createUserDto->password;
        $user->role_id = $createUserDto->roleId;
        $user->phone_number = $createUserDto->phoneNumber;
        $user->description = $createUserDto->description;
        $user->image_path = $createUserDto->imagePath;
        $user->save();
        return $user;
    }
}
