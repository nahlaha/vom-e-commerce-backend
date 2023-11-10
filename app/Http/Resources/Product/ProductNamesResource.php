<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Http\Resources\BaseJsonResource;

class ProductNamesResource extends BaseJsonResource
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
            'product_id' => $this->product_id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
