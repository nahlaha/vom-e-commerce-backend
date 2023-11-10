<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\Product\CreateProductDto;
use App\Models\Product;
use App\Repositories\Interfaces\IProductRepo;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
final class ProductRepository implements IProductRepo
{

    public function __construct(private Product $product)
    {
    }

    /**
     * Creates a new Product
     * @param CreateProductDto $createProductDto
     * @return Product
     */
    public function createProduct(CreateProductDto $createProductDto): Product
    {
        $this->product->store_id = $createProductDto->storeId;
        $this->product->price = $createProductDto->price;
        $this->product->save();
        return $this->product;
    }

    /**
     * get unique Product by name and store id
     * @param string $name
     * @param int $storeId
     * @return Product
     */
    public function getProductByStoreAndName(array $names, int $storeId): Product|null
    {
        return $this->product->query()
            ->where('store_id', $storeId)
            ->whereHas('productNames', function ($q) use ($names) {
                $q->whereIn('name', $names);
            })->first();
    }


    public function getProductsByIds(array $ids): array
    {
        return $this->product::query()->whereIn('id', $ids)->with('store')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product['id'],
                    'price' => $product['price'],
                    'vat_type_id' => $product['store']['vat_type_id'],
                    'vat_value' => $product['store']['vat_value'],
                    'shipping_cost' => $product['store']['shipping_cost'],
                    'store_id' => $product['store']['id'],
                ];
            })->toArray();
    }
}
