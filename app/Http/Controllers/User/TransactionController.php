<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\UserTransactionInterface;
use Carbon\Carbon;
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
                ->of($this->transaction->getByUserId(auth()->user()->id))
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
                ->addColumn('status_order', function ($data) {
                    return strtoupper($data->getStatusOrderLabel());
                })
                ->addColumn('status_payment', function ($data) {
                    return strtoupper($data->getStatusPaymentLabel());
                })
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM Y H:m');
                })
                ->addColumn('action', function ($data) {
                    return view('user.transaction.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('user.transaction.index');
    }
    // detail transaction
    public function detail($id)
    {
        $transaction = $this->transaction->getByUserId(auth()->user()->id)->where('id', $id)->first();
        return view(
            'user.transaction.detail',
            compact('transaction')
        );
    }
}
