<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dtos\Store\CreateStoreDto;
use App\Models\Store;

interface IStoreRepo
{
    public function getStoreByNameAndUser(string $name, int $userId): Store|null;

    public function createStore(CreateStoreDto $createStoreDto): Store;

    public function getStoreById(int $id): Store|null;
}
