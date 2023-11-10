<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Closure;
use Illuminate\Database\Eloquent\Model;

interface IDbTransaction
{
    public function createTransaction(Closure $callbackFunction): void;
}
