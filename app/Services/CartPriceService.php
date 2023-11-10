<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\VatType;
use App\Services\Interfaces\ICartPriceService;
use App\Dtos\Cart\CartProductPriceDto;
use App\Libraries\Interfaces\IProductPrice;
use App\Libraries\ProductPriceIncludedVat;
use App\Libraries\ProductPriceFixedVat;
use App\Libraries\ProductPricePercentageVat;

class CartPriceService implements ICartPriceService
{

    private ?IProductPrice $service = null;

    public function calcProductPrice(CartProductPriceDto $cartProductPriceDto): float
    {
        $this->make(VatType::from($cartProductPriceDto->vatType));
        return $this->service->caclProductPrice($cartProductPriceDto);
    }


    private function make(VatType $vatType): IProductPrice
    {
        switch ($vatType) {
            case VatType::INCLUDED:
                $this->setService(ProductPriceIncludedVat::class);
                break;
            case VatType::PERCENTAGE:
                $this->setService(ProductPricePercentageVat::class);
                break;
            case VatType::FIXED:
                $this->setService(ProductPriceFixedVat::class);
                break;
            default:
                $this->setService(ProductPriceIncludedVat::class);
                break;
        }
        return $this->service;
    }



    private function setService(string $class): void
    {
        if ($this->service && is_a($this->service, $class)) {
            return;
        }
        $this->service = new $class();
    }
}
