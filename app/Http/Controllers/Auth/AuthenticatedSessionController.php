<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (auth()->user()->role == 1) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } elseif (auth()->user()->role == 2 && auth()->user()->is_verificator == false) {
            return redirect()->intended(RouteServiceProvider::HOME_INSTITUTION);
        } elseif (auth()->user()->role == 3 && auth()->user()->is_verificator == false) {
            return redirect()->intended(RouteServiceProvider::HOME_USER);
        } elseif (auth()->user()->is_verificator == true) {
            return redirect()->intended(RouteServiceProvider::HOME_VERIFICATOR);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout!');
    }
}
