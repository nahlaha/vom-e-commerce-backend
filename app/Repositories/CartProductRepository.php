<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\Cart\CartProductsDto;
use App\Models\CartProduct;
use App\Repositories\Interfaces\ICartProductsRepo;

/**
 * Class CartProductRepository
 * @package App\Repositories
 */
final class CartProductRepository implements ICartProductsRepo
{

    public function __construct(private CartProduct $cartProduct)
    {
    }

    /**
     * Creates array of
     * @param array $cartProducts
     * @return bool
     */
    public function createCartProducts(CartProductsDto $cartProductDto): bool
    {
        return $this->cartProduct::insert($cartProductDto->cartProducts);
    }
}
