<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Constants\Regex;
use App\Constants\Role;
use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $commonValidation = 'nullable|max:255|regex:';
        return [
            'first_name' => $commonValidation . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
            'last_name' => $commonValidation . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
            'email' => 'nullable|email',
            'phone_number' => 'nullable|max:10|regex:' . Regex::NUMBERS_DASH,
            'description' => $commonValidation . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
