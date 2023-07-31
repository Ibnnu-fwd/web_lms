<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isVerificator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->is_verificator == true) {
            return $next($request);
        } else {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
        }
    }
}
