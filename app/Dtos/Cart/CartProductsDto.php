<?php

declare(strict_types=1);

namespace App\Dtos\Cart;

final class CartProductsDto
{


    public function __construct(int $cartId, array $products, public array $cartProducts)
    {
        $cartProductsTemp = [];
        foreach ($products as $product) {
            foreach ($this->cartProducts as $cartProduct) {
                if ($product['id'] === ((int) $cartProduct['product_id'])) {
                    array_push($cartProductsTemp, [
                        'cart_id' => $cartId,
                        'product_id' => $product['id'],
                        'quantity' => $cartProduct['quantity'],
                        'product_price' => $product['price'],
                        'vat_type_id' => $product['vat_type_id'],
                        'vat_value' => $product['vat_value'],
                        'shipping_cost' => $product['shipping_cost']
                    ]);
                }
            }
        }
        $this->cartProducts = $cartProductsTemp;
    }
}
