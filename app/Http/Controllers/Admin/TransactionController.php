<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct(
        TransactionInterface $transaction
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
                ->addColumn('status_order', function ($data) {
                    return strtoupper($data->getStatusOrderLabel());
                })
                ->addColumn('status_payment', function ($data) {
                    return strtoupper($data->getStatusPaymentLabel());
                })
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D/MM/Y H:m');
                })
                ->addColumn('action', function ($data) {
                    if ($data->status_order !== 3) {
                        return view('admin.transaction.column.action', compact('data'));
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.transaction.index');
    }

    public function detail($id)
    {
        $transaction = $this->transaction->getById($id);
        return view('admin.transaction.detail', compact('transaction'));
    }

    public function approve($id)
    {
        try {
            $this->transaction->approve($id);
            return redirect()->back()->with('success', 'Berhasil menyetujui transaksi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menyetujui transaksi');
        }
    }

    public function decline($id)
    {
        try {
            $this->transaction->decline($id);
            return redirect()->back()->with('success', 'Berhasil menolak transaksi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menolak transaksi');
        }
    }
}
