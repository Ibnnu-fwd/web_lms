<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // if (auth()->user()->status == 1) {
        //     return $next($request);
        // } else {
        //     auth()->logout();
        //     return redirect('/login')->with('error', 'Akun anda tidak aktif!');
        // }

        if (auth()->user()->status == 1) {
            if (in_array(auth()->user()->role, $roles)) {
                return $next($request);
            } else {
                auth()->logout();
                return redirect('/login')->with('error', 'Akun anda tidak aktif!');
            }
        } else {
            auth()->logout();
            return redirect('/login')->with('error', 'Akun anda tidak aktif!');
        }
    }
}
