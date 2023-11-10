<?php

declare(strict_types=1);

namespace App\Libraries;

use App\Dtos\Cart\CartProductPriceDto;
use App\Libraries\Interfaces\IProductPrice;

class ProductPriceIncludedVat implements IProductPrice
{
    public function caclProductPrice(CartProductPriceDto $dto): float
    {
        return $dto->productPrice * $dto->quantity;
    }
}
