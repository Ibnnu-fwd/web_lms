<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->role == User::ROLE_ADMIN) {
            return view('admin.dashboard');
        } elseif (auth()->user()->role == User::ROLE_USER) {
            return view('user.dashboard');
        }
    }
}
