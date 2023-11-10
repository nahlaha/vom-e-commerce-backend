<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\Cart\CreateCartDto;
use App\Models\Cart;
use App\Repositories\Interfaces\ICartRepo;

/**
 * Class CartRepository
 * @package App\Repositories
 */
final class CartRepository implements ICartRepo
{

    public function __construct(private Cart $cart)
    {
    }

    /**
     * Creates a cart
     * @param CreateCartDto $createCartDto
     * @return cart
     */
    public function createCart(CreateCartDto $createCartDto): Cart
    {
        $this->cart->user_id = $createCartDto->userId;
        $this->cart->total_price = $createCartDto->totalPrice;
        $this->cart->save();
        return $this->cart;
    }
}
