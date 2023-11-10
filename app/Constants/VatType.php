<?php

namespace App\Constants;

enum VatType: int
{
    case INCLUDED = 1;
    case PERCENTAGE = 2;
    case FIXED = 3;
}
