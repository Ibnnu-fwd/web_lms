<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\User\UserTransactionInterface;
use Carbon\Carbon;

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
        $transaction = $this->transaction->getByUserId(auth()->user()->id);

        if ($request->ajax()) {
            return datatables()
                ->of($transaction)
                ->addColumn('transaction_code', function ($data) {
                    return $data->transaction_code;
                })
                ->addColumn('transaction_type', function ($data) {
                    return strtoupper($data->transaction_type);
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
                    return Carbon::parse($data->created_at)->isoFormat('DD/MM/Y H:m');
                })
                ->addColumn('action', function ($data) {
                    return view('institution.transaction.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('institution.transaction.index');
    }

    public function detail($id)
    {
        $transaction = $this->transaction->getById($id);
        return view('institution.transaction.detail', compact('transaction'));
    }

    public function uploadPayment($id, Request $request)
    {
        $this->validate($request, [
            'proof_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $this->transaction->uploadPayment($id, $request->all());
            return redirect()->back()->with(['success' => 'Upload bukti pembayaran berhasil']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function cancel($id)
    {
        try {
            $this->transaction->cancel($id);
            return redirect()->back()->with(['success' => 'Transaksi berhasil dibatalkan']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
