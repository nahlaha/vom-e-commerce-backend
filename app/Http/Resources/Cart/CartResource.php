<?php

declare(strict_types=1);

namespace App\Http\Resources\Cart;

use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\Product\ProductNamesResource;

class CartResource extends BaseJsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
   public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'products' => ProductNamesResource::collection($this->whenLoaded('productNames'))

        ];
    }
}
