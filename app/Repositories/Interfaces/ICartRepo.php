<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dtos\Cart\CreateCartDto;
use App\Models\Cart;

interface ICartRepo
{
    public function createCart(CreateCartDto $createCartDto): Cart;
}
