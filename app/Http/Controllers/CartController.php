<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\Cart\CreateCartDto;
use App\Http\Requests\Cart\CreateCartRequest;
use App\Http\Resources\Product\CartResource;
use App\Services\Interfaces\ICartService;
use App\Services\ResponseService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{

    public function __construct(private ResponseService $responseService, private ICartService $cartService)
    {
    }

    /**
     * create store
     * @param CreateCartRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function createCart(CreateCartRequest $request)
    {
        $cart = $this->cartService->createCart(new CreateCartDto(
            Auth::user()->id,
            (array)$request->input('products')
        ));
        return $this->responseService->getSuccessResponse(new CartResource($cart));
    }
}
