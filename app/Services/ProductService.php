<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\Product\CreateProductDto;
use App\Exceptions\ApplicationException;
use App\Models\Product;
use App\Repositories\Interfaces\IProductNameRepo;
use App\Repositories\Interfaces\IProductRepo;
use App\Repositories\Interfaces\IDbTransaction;
use App\Services\Interfaces\IProductService;


/**
 * Class ProductService
 * @package App\Services
 */
final class ProductService implements IProductService
{

    public function __construct(
        private IProductRepo $productRepo,
        private IProductNameRepo $productNameRepo,
        private IDbTransaction $dbTransaction
    ) {
    }

    /**
     * @param CreateProductDto $createProducDto
     * @return Product
     * @throws ApplicationException
     */
    public function createProduct(CreateProductDto $createProducDto): Product|null
    {
        $product = $this->productRepo->getProductByStoreAndName(
            array_column($createProducDto->productNames, 'name'),
            $createProducDto->storeId
        );
        if (!is_null($product)) {
            throw new ApplicationException(Error::PRODUCT_NAME_ALREADY_EXISTS->value);
        }

        $this->dbTransaction->createTransaction(function () use ($createProducDto, &$product) {
            $product = $this->productRepo->createProduct($createProducDto);
            $this->productNameRepo->createProductNames($createProducDto->getProductNames($product->id));
        });
        return $product;
    }
}
