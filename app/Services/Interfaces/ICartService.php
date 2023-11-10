<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Dtos\Cart\CreateCartDto;
use App\Models\Cart;

interface ICartService
{
    public function createCart(CreateCartDto $createCartDto): Cart|null;
}
