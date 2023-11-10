<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dtos\User\CreateUserDto;
use App\Models\User;

interface IUserRepo
{
    public function getUserByEmail(string $email): User|null;

    public function createUser(CreateUserDto $createUserDto): User;
}
