<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction\Transaction;

class TransactionRepository implements TransactionInterface
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getAll()
    {
        return $this->transaction->all();
    }

    public function getByUserId($userId)
    {
        return $this->transaction->where('customer_id', $userId)->get();
    }
}
