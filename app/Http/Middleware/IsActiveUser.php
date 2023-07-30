<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsActiveUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->status == 1) {
            return $next($request);
        } else {
            auth()->logout();
            return redirect('/login')->with('error', 'Akun anda tidak aktif!');
        }
    }
}
