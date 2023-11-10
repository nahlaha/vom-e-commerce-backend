<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dtos\Cart\CartProductsDto;

interface ICartProductsRepo
{
    public function createCartProducts(CartProductsDto $cartProductDto): bool;

}
