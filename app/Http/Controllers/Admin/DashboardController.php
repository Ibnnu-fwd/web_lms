<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $role = $user->role;

        if ($user->is_verificator) {
            return view('verificator.dashboard');
        }

        switch ($role) {
            case User::ROLE_ADMIN:
                return view('admin.dashboard');
            case User::ROLE_INSTITUTION:
                return view('institution.dashboard');
            case User::ROLE_USER:
                return view('user.dashboard');
            default:
                abort(404);
        }
    }
}
