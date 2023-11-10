<?php

declare(strict_types=1);

namespace App\Dtos\Product;

final class ProductNameDto
{

    public function __construct(
        public int $languageType,
        public string $name,
        public ?string $description,
    ) {
    }
}
