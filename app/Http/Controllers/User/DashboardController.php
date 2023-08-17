<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\UserTransactionInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $transaction;

    public function __construct(UserTransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function __invoke()
    {
        $detailTransaction = $this->transaction->getApprovedTransactionUser(auth()->id());
        foreach ($detailTransaction as $dt) {
            $dt->isExpired = date('Y-m-d H:i:s', strtotime($dt->end_date . ' + 1 days')) < date('Y-m-d H:i:s');
        }

        return view('user.dashboard', [
            'detailTransaction' => $detailTransaction
        ]);
    }
}
