<?php

declare(strict_types=1);

namespace App\Dtos\User;

use App\Constants\SortOptions;

final class GetUsersDto
{

    public string $recodePerPage;
    public string $sortBy;
    public string $sortOrder;

    public function __construct()
    {
        $this->recodePerPage = config('ecommerce.record_per_page');
        $this->sortBy = SortOptions::from(SortOptions::BY_ID->value)->getUserSortBy();
        $this->sortOrder = SortOptions::from(SortOptions::ORDER_DESCENDING->value)->getSortOrder();
    }
}
