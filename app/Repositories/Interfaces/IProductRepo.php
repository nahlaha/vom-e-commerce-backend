<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dtos\Product\CreateProductDto;
use App\Models\Product;

interface IProductRepo
{
    public function getProductByStoreAndName(array $names, int $storeId): Product|null;

    public function createProduct(CreateProductDto $createProductDto): Product;

    public function getProductsByIds(array $ids): array;
}
