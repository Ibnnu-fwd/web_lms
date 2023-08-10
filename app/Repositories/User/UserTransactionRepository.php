<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserTransactionInterface;
use App\Models\Transaction\DetailTransaction;
use App\Models\Transaction\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserTransactionRepository implements UserTransactionInterface
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
        return $this->transaction->with(['customer'])->get();
    }

    public function getByUserId($userId)
    {
        return $this->transaction->where('customer_id', $userId)->get();
    }

    public function getById($id)
    {
        return $this->transaction->find($id)->with('detailTransaction')->first();
    }

    public function uploadPayment($id, $data)
    {
        DB::beginTransaction();

        $proofPaymentFilename = uniqid() . '.' . $data['proof_payment']->extension();
        try {
            $this->transaction->find($id)->update([
                'payment_proof'  => $proofPaymentFilename,
                'status_payment' => Transaction::STATUS_PAYMENT_PAID
            ]);

            $data['proof_payment']->storeAs('public/proof_payment', $proofPaymentFilename);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            // Delete file if failed
            Storage::delete('public/proof_payment/' . $proofPaymentFilename);

            throw $th;
        }
    }

    public function cancel($id)
    {
        DB::beginTransaction();

        try {
            $this->transaction->find($id)->update([
                'status_order' => Transaction::STATUS_ORDER_CANCEL,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }
    }

    public function getApprovedTransactionUser($userId)
    {
        $detailTransaction = $this->detailTransaction->whereHas('transaction', function ($query) use ($userId) {
            $query->where('customer_id', $userId)
                ->where('status_order', Transaction::STATUS_ORDER_SUCCESS);
        })
            ->with(['course'])
            ->get();

        // get progress course
        $detailTransaction->map(function ($item) {
            $item->course->progress = $item->course->getProgressCourse(auth()->id());
        });

        return $detailTransaction;
    }
}
