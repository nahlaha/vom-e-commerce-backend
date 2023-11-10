<?php

declare(strict_types=1);

namespace App\Libraries;

use App\Dtos\Cart\CartProductPriceDto;
use App\Libraries\Interfaces\IProductPrice;

class ProductPriceFixedVat implements IProductPrice
{
    public function caclProductPrice(CartProductPriceDto $dto): float
    {
        $price = $dto->vatValue + $dto->productPrice;
        return $price * $dto->quantity;
    }
}
