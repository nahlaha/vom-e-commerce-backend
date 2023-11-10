<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\Product\CreateProductDto;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Services\Interfaces\IStoreService;
use App\Services\ResponseService;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{

    public function __construct(private ResponseService $responseService, private IStoreService $storeService)
    {
    }

    /**
     * create Product
     * @param CreateProductRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function createProduct(CreateProductRequest $request)
    {
        $product = $this->storeService->createStoreProduct(new CreateProductDto(
            (int)$request->input('store_id'),
            (float)$request->input('price'),
            (array)$request->input('product_names'),
        ));
        return $this->responseService->getSuccessResponse(new ProductResource($product));
    }
}
