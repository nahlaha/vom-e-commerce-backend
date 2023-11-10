<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ProductName;
use App\Repositories\Interfaces\IProductNameRepo;

/**
 * Class ProductNameRepository
 * @package App\Repositories
 */
final class ProductNameRepository implements IProductNameRepo
{

    public function __construct(private ProductName $productName)
    {
    }

    /**
     * Creates array of Productnames
     * @param array $productNames
     * @return bool
     */
    public function createProductNames(array $productNames): bool
    {
        return $this->productName::insert($productNames);
    }
}
