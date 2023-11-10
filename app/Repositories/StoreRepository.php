<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\Store\CreateStoreDto;
use App\Models\Store;
use App\Repositories\Interfaces\IStoreRepo;

/**
 * Class StoreRepository
 * @package App\Repositories
 */
final class StoreRepository implements IStoreRepo
{
    /**
     * Creates a new store
     * @param CreateStoreDto $createStoreDto
     * @return Store
     */
    public function createStore(CreateStoreDto $createStoreDto): Store
    {
        $store = new Store();
        $store->name = $createStoreDto->name;
        $store->shipping_cost = $createStoreDto->shippingCost;
        $store->vat_type_id = $createStoreDto->vatType;
        $store->vat_value = $createStoreDto->vatValue;
        $store->user_id = $createStoreDto->userId;
        $store->save();
        return $store;
    }

    /**
     * get unique store by name and user id
     * @param string $name
     * @param int $userId
     * @return Store
     */
    public function getStoreByNameAndUser(string $name, int $userId): Store|null
    {
        return Store::whereRaw("lower(name) = (?)", strtolower($name))->where('user_id', $userId)->first();
    }

    /**
     * get store by id
     * @param int $id
     * @return Store
     */
    public function getStoreById(int $id): Store|null
    {
        return Store::find($id);
    }
}
