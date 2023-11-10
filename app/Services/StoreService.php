<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\Product\CreateProductDto;
use App\Dtos\Store\CreateStoreDto;
use App\Exceptions\ApplicationException;
use App\Models\Product;
use App\Models\Store;
use App\Repositories\Interfaces\IStoreRepo;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IStoreService;

/**
 * Class StoreService
 * @package App\Services
 */
final class StoreService implements IStoreService
{

    public function __construct(private IStoreRepo $storeRepo, private IProductService $productService)
    {
    }

    /**
     * @param CreateStoreDto $createStoreDto
     * @return Store
     * @throws ApplicationException
     */
    public function createStore(CreateStoreDto $createStoreDto): Store
    {
        $store = $this->storeRepo->getStoreByNameAndUser($createStoreDto->name, $createStoreDto->userId);
        if (!is_null($store)) {
            throw new ApplicationException(Error::STORE_NAME_ALREADY_EXISTS->value);
        }
        return $this->storeRepo->createStore($createStoreDto);
    }


    /**
     * @param CreateProductDto $createProductDto
     * @return Product|null
     * @throws ApplicationException
     */
    public function createStoreProduct(CreateProductDto $createProductDto): Product|null
    {
        $store = $this->storeRepo->getStoreById($createProductDto->storeId);
        if (is_null($store)) {
            throw new ApplicationException(Error::STORE_NOT_FOUND->value);
        }
        return $this->productService->createProduct($createProductDto);
    }
}
