<?php

declare(strict_types=1);

namespace App\Dtos\Cart;

final class CreateCartDto
{

    public float $totalPrice;

    public function __construct(public int $userId, public array $products)
    {
    }
}
