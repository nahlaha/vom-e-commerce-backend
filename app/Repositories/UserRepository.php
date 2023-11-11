<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\User\CreateUserDto;
use App\Dtos\User\GetUsersDto;
use App\Dtos\User\UpdateUserDto;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepo;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 * @package App\Repositories
 */
final class UserRepository implements IUserRepo
{

    public function __construct(private User $user)
    {
    }

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User|null
    {
        return $this->user->where('email', $email)->first();
    }

    /**
     * Creates a new user
     * @param CreateUserDto $createUserDto
     * @return User
     */
    public function createUser(CreateUserDto $createUserDto): User
    {
        $this->user->first_name = $createUserDto->firstName;
        $this->user->last_name = $createUserDto->lastName;
        $this->user->email = $createUserDto->email;
        $this->user->password = $createUserDto->password;
        $this->user->role_id = $createUserDto->roleId;
        $this->user->phone_number = $createUserDto->phoneNumber;
        $this->user->description = $createUserDto->description;
        $this->user->image_path = $createUserDto->imagePath;
        $this->user->save();
        return $this->user;
    }

    /**
     * delete a user
     */
    public function deleteUser(int $id): bool|null
    {
        return $this->user->query()->find($id)->delete();
    }

    /**
     * update user
     * @param UpdateUserDto $updateUserDto
     * @return bool
     */
    public function updateUser(UpdateUserDto $updateUserDto): bool
    {
        $this->user->where('id', $updateUserDto->id);
        if (!is_null($updateUserDto->firstName)) {
            $this->user->first_name = $updateUserDto->firstName;
        }
        if (!is_null($updateUserDto->lastName)) {
            $this->user->last_name = $updateUserDto->lastName;
        }
        if (!is_null($updateUserDto->email)) {
            $this->user->email = $updateUserDto->email;
        }
        if (!is_null($updateUserDto->phoneNumber)) {
            $this->user->phone_number = $updateUserDto->phoneNumber;
        }
        if (!is_null($updateUserDto->description)) {
            $this->user->description = $updateUserDto->description;
        }
        if (!is_null($updateUserDto->imagePath)) {
            $this->user->image_path = $updateUserDto->imagePath;
        }
        return $this->user->save();
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User|null
    {
        return $this->user->where('id', $id)->first();
    }

    /**
     * @param GetUsersDto $getUsersDto
     * @return \Illuminate\Support\Collection
     */
    public function getUsers(GetUsersDto $getUsersDto): Collection
    {
        $query = $this->user->select('*');

        $query->orderBy($getUsersDto->sortBy, $getUsersDto->sortOrder);

        return $query->paginate($getUsersDto->recodePerPage);
    }
}
