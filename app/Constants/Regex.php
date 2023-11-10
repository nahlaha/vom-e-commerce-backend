<?php

declare(strict_types=1);

namespace App\Constants;

class Regex
{
    const ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS = '/^[a-zA-Z0-9-_~!@#$%^&*()\[\]{}<>.\/\\\\ ]+$/';
    const PASSWORD = '/^[a-zA-Z0-9-_~@#$\/\\\\ ]*$/';
    const NUMBERS_DASH ='/^[0-9-]*$/';
}
