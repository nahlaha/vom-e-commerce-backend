<?php

declare(strict_types=1);

namespace App\Http\Resources\Store;

use App\Http\Resources\BaseJsonResource;

class StoreResource extends BaseJsonResource
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
            'name' => $this->name,
            'shipping_cost' => $this->shipping_cost,
            'vat_type_id' => $this->vat_type_id,
            'vat' => $this->vat_value,
            'created_at' => $this->created_at,
        ];
    }
}
