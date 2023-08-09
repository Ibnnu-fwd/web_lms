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
        return view('user.dashboard', [
            'detailTransaction' => $this->transaction->getApprovedTransactionUser(auth()->id())
        ]);
    }
}
