<?php

declare(strict_types=1);

namespace App\Dtos\Cart;

class CartProductPriceDto
{

    public function __construct(
        public float $productPrice,
        public int $quantity,
        public int $vatType,
        public ?float $vatValue = null,
    ) {
    }
}
