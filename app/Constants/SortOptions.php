<?php

namespace App\Constants;


enum SortOptions: int
{
    case ORDER_ASCENDING = 1;
    case ORDER_DESCENDING = 2;
    case BY_ID = 3;

    public function getSortOrder(): int
    {
        return match ($this) {
            SortOptions::ORDER_ASCENDING => 'ASC',
            SortOptions::ORDER_DESCENDING => 'DESC',
        };
    }

    public function getUserSortBy(): string
    {
        return match ($this) {
            SortOptions::BY_ID => 'id',
        };
    }
}
