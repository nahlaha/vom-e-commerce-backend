<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dtos\User\CreateUserDto;
use App\Dtos\User\GetUsersDto;
use App\Dtos\User\UpdateUserDto;
use App\Models\User;

interface IUserRepo
{
    public function getUserByEmail(string $email): User|null;

    public function createUser(CreateUserDto $createUserDto): User;

    public function getUserById(int $id): User|null;

    public function updateUser(UpdateUserDto $updateUserDto): bool;

    public function deleteUser(int $id): bool|null;

    public function getUsers(GetUsersDto $getUsersDto);
}
