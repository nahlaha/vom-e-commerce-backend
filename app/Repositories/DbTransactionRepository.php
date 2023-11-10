<?php

declare(strict_types=1);

namespace App\Repositories;


use App\Repositories\Interfaces\IDbTransaction;
use Closure;
use Illuminate\Support\Facades\DB;

class DbTransactionRepository implements IDbTransaction
{
    /**
     * create database transaction
     * @param Closure $callbackFunction
     * @return void
     */
    public function createTransaction(Closure $callbackFunction): void
    {
        DB::transaction($callbackFunction);
    }
}
