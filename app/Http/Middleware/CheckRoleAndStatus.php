<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleAndStatus
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (in_array($user->role, $roles)) {
            return $next($request);
        } else {
            auth()->logout();
            return redirect('/login')->with('error', 'Anda tidak memiliki akses!');
        }
    }
}
