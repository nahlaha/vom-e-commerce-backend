<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Http\Resources\BaseJsonResource;

/**
 *
 * @property string $token
 */
class AuthResource extends BaseJsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return ['token' => $this->accessToken];
    }
}
