<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Dtos\Cart\CartProductPriceDto;

interface ICartPriceService
{
    public function calcProductPrice(CartProductPriceDto $cartProductPriceDto): float;
}
