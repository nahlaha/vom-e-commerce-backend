<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Http\Resources\BaseJsonResource;

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
            'total_vat' => $this->total_vat,
            'products' => ProductNamesResource::collection($this->whenLoaded('productNames'))

        ];
    }
}
