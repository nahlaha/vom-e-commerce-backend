<?php

declare(strict_types=1);

namespace App\Dtos\Cart;

class CartProductDto
{

    public function __construct(
        public int $id,
        public int $storeId,
        public int $price,
        public float $vatType,
        public ?float $vatValue,
        public ?float $shipping_cost
    ) {
    }
}
