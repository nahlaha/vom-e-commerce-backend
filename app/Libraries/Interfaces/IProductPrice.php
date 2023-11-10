<?php

declare(strict_types=1);

namespace App\Libraries\Interfaces;

use App\Dtos\Cart\CartProductPriceDto;

interface IProductPrice
{
    public function caclProductPrice(CartProductPriceDto $cartProductPriceDto): float;
}
