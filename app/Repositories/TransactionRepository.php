<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction\DetailTransaction;
use App\Models\Transaction\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionRepository implements TransactionInterface
{
    private $transaction;
    private $detailTransaction;

    public function __construct(Transaction $transaction, DetailTransaction $detailTransaction)
    {
        $this->transaction       = $transaction;
        $this->detailTransaction = $detailTransaction;
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

    public function checkoutPayment($data)
    {
        $transactionCode = 'TRX' . time();
        DB::beginTransaction();

        try {
            $transaction = $this->transaction->create([
                'transaction_code' => $transactionCode,
                'transaction_type' => Transaction::TRANSACTION_TYPE_BUY,
                'customer_id'      => auth()->user()->id,
                'sub_total'        => $data['total_price'],
                'total_payment'    => $data['total_price'],
                'status_order'     => Transaction::STATUS_ORDER_WAITING,
                'status_payment'   => Transaction::STATUS_PAYMENT_WAITING,
                'payment_proof'    => null,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        try {
            foreach ($data['carts'] as $cart) {
                $rentMonth = $cart['rent_month'];
                $this->detailTransaction->create([
                    'transaction_id' => $transaction->id,
                    'course_id'      => $cart['id'],
                    'start_date'     => now(),
                    'end_date'       => now()->addMonth($rentMonth),
                    'total_month'    => $cart['rent_month'],
                    'sub_total'      => $cart['total_price'],
                    'total_payment'  => $cart['total_price'],
                    'customer_id'    => auth()->user()->id,
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        DB::commit();
    }
}
