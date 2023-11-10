<?php

declare(strict_types=1);

namespace App\Dtos\Store;

final class CreateStoreDto
{

    public function __construct(
        public int $userId,
        public string $name,
        public int $vatType,
        public ?float $vatValue,
        public ?float $shippingCost,
    ) {
    }
}
