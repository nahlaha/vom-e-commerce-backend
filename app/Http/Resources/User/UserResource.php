<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Http\Resources\BaseJsonResource;

class UserResource extends BaseJsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'phone_number' => $this->phone_number,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
