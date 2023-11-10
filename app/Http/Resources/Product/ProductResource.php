<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Http\Resources\BaseJsonResource;

class ProductResource extends BaseJsonResource
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
            'store_id' => $this->store_id,
            'price' => $this->price,
            'names' => ProductNamesResource::collection($this->whenLoaded('productNames'))

        ];
    }
}
