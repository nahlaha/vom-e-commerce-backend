<?php

declare(strict_types=1);

namespace App\Dtos\Product;

final class CreateProductDto
{

    public function __construct(
        public int $storeId,
        public float $price,
        public array $productNames, //array of product names {languageType,name,description}
    ) {
    }

    public function getProductNames(int $productId): array
    {
        $productNames = [];
        foreach ($this->productNames as $value) {
            $productName['product_id'] = $productId;
            $productName['name'] = $value['name'];
            $productName['language_id'] = $value['language_id'];
            $productName['description'] = $value['description'] ?? null;
            array_push($productNames, $productName);
        }
        return $productNames;
    }
}
