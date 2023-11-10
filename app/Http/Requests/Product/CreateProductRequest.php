<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Constants\Language;
use App\Constants\Regex;
use App\Constants\Role;
use App\Http\Requests\BaseRequest;
use App\Services\Interfaces\IAuthorizationService;

class CreateProductRequest extends BaseRequest
{

    public function __construct(private IAuthorizationService $authorizationService)
    {
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->authorizationService->isUserAuthorized(Role::MERCHANT->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'store_id' => 'required|int',
            'price' => 'required|numeric|between:0,999.99',
            'product_names' => 'required|array',
            'product_names.*.name' => 'required|max:255|regex:' . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
            'product_names.*.description' => 'nullable|max:255|regex:'
                . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
            'product_names.*.language_id' => 'required|in:' . implode(',', array_column(Language::cases(), 'value')),
        ];
    }
}
