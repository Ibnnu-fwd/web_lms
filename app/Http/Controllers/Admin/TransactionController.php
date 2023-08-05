<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                    return $data->customer->fullname;
                })
                ->addColumn('sub_total', function ($data) {
                    return $data->sub_total;
                })
                ->addColumn('total_payment', function ($data) {
                    return $data->total_payment;
                })
                ->addColumn('status', function ($data) {
                    return $data->status;
                })
                ->addColumn('payment_status', function ($data) {
                    return $data->payment_status;
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.transaction.column.action', compact('data'));
                });
        }
        return view('admin.transaction.index');
    }
}