<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\Cart\CartProductPriceDto;
use App\Dtos\Cart\CartProductsDto;
use App\Dtos\Cart\CreateCartDto;
use App\Exceptions\ApplicationException;
use App\Models\Cart;
use App\Repositories\Interfaces\ICartProductsRepo;
use App\Repositories\Interfaces\ICartRepo;
use App\Repositories\Interfaces\IDbTransaction;
use App\Services\Interfaces\ICartPriceService;
use App\Services\Interfaces\ICartService;
use App\Services\Interfaces\IProductService;

/**
 * Class CartService
 * @package App\Services
 */
final class CartService implements ICartService
{

    public function __construct(
        private IProductService $productService,
        private ICartRepo $cartRepo,
        private ICartProductsRepo $cartProductRepo,
        private IDbTransaction $dbTransaction,
        private ICartPriceService $cartPriceService
    ) {
    }

    /**
     * @param CreateCartDto $createCartDto
     * @return Cart
     * @throws ApplicationException
     */
    public function createCart(CreateCartDto $createCartDto): Cart|null
    {
        $products = $this->productService->getProductsByIds(array_column($createCartDto->products, 'product_id'));
        if (count($products) === 0 || count($products) !== count($createCartDto->products)) {
            throw new ApplicationException(Error::PRODUCTS_NOT_EXISTS->value);
        }
        $createCartDto->totalPrice = $this->calcCart($products, $createCartDto->products);
        $cart = null;
        $this->dbTransaction->createTransaction(function () use ($createCartDto, $products, &$cart) {
            $cart = $this->cartRepo->createCart($createCartDto);
            $cartProductDto = new CartProductsDto(
                $cart->id,
                $products,
                $createCartDto->products
            );
            $this->cartProductRepo->createCartProducts($cartProductDto);
        });
        return $cart;
    }

    public function calcCart(array $products, array $selectedProducs)
    {
        $totalPrice = 0.0;
        $shippingCosts = [];
        foreach ($products as $element) {
            $shippingCosts[$element['store_id']]['shipping_cost'] = $element['shipping_cost'] ?? 0;
            foreach ($selectedProducs as $p) {
                if (((int)$p['product_id']) === $element['id']) {
                    $element['quantity'] = $p['quantity'];
                }
            }
            $totalPrice += $this->cartPriceService->calcProductPrice(new CartProductPriceDto(
                (float)$element['price'],
                (int)$element['quantity'],
                $element['vat_type_id'],
                (float)$element['vat_value']
            ));
        }
        return $totalPrice + array_sum(array_column($shippingCosts, 'shipping_cost'));
    }
}
