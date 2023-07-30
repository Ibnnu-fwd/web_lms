<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserTransactionInterface;
use App\Models\Transaction\Transaction;

class UserTransactionRepository implements UserTransactionInterface
{

    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getAll()
    {
        return $this->transaction->with(['customer'])->get();
    }
}
