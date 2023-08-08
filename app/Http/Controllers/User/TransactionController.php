<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\UserTransactionInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct(
        UserTransactionInterface $transaction
    ) {
        $this->transaction = $transaction;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->transaction->getAll())
                ->addColumn('transaction_code', function ($data) {
                    return $data->transaction_code;
                })
                ->addColumn('transaction_type', function ($data) {
                    return $data->transaction_type;
                })
                ->addColumn('customer', function ($data) {
                    return $data->customer->name;
                })
                ->addColumn('sub_total', function ($data) {
                    return $data->sub_total;
                })
                ->addColumn('total_payment', function ($data) {
                    return $data->total_payment;
                })
                ->addColumn('status_order', function ($data) {
                    return $data->status_order;
                })
                ->addColumn('status_payment', function ($data) {
                    return $data->status_payment;
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at ?? '-';
                })
                ->addColumn('action', function ($data) {
                    return view('user.transaction.column.action', compact('data'));
                });
        }
        // dd($this->transaction->getAll());
        return view('user.transaction.index');
    }
}
