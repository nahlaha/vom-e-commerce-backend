<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\Store\CreateStoreDto;
use App\Http\Requests\Store\CreateStoreRequest;
use App\Http\Resources\Store\StoreResource;
use App\Services\Interfaces\IStoreService;
use App\Services\ResponseService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class StoreController extends BaseController
{

    public function __construct(private ResponseService $responseService, private IStoreService $storeService)
    {
    }

    /**
     * create store
     * @param CreateStoreRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function createStore(CreateStoreRequest $request)
    {
        $store = $this->storeService->createStore(new CreateStoreDto(
            Auth::user()->id,
            $request->input('name'),
            (int)$request->input('vat_type'),
            (float)$request->input('vat_value'),
            (float)$request->input('shipping_cost')
        ));
        return $this->responseService->getSuccessResponse(new StoreResource($store));
    }
}
