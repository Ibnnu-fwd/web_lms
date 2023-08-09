<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction\Transaction;
use Illuminate\Support\Facades\Storage;

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

    public function getById($id)
    {
        return $this->transaction->with(['detailTransaction.course', 'customer'])->find($id);
    }

    public function approve($id)
    {
        $transaction                 = $this->transaction->find($id);
        $transaction->status_payment = Transaction::STATUS_PAYMENT_CONFIRM;
        $transaction->status_order   = Transaction::STATUS_ORDER_SUCCESS;
        $transaction->save();

        return $transaction;
    }

    public function decline($id)
    {
        $transaction                 = $this->transaction->find($id);
        $transaction->status_payment = Transaction::STATUS_PAYMENT_DECLINE;
        $transaction->status_order   = Transaction::STATUS_ORDER_REJECT;
        $transaction->payment_proof  = null;
        $transaction->save();

        Storage::delete('public/proof_payment/' . $transaction->payment_proof);

        return $transaction;
    }
}
