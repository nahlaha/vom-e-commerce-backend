<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Dtos\Product\CreateProductDto;
use App\Dtos\Store\CreateStoreDto;
use App\Models\Product;
use App\Models\Store;

interface IStoreService
{
    public function createStore(CreateStoreDto $createStoreDto): Store;

    public function createStoreProduct(CreateProductDto $createProductDto): Product|null;
}
