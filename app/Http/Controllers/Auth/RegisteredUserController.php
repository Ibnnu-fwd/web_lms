<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'gender' => ['required', 'in:L,P'],
            'birthday' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:20'],
            'job' => ['nullable', 'string', 'max:255'],
            'institution' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender'),
            'birthday' => $request->input('birthday'),
            'phone' => $request->input('phone'),
            'job' => $request->input('job'),
            'institution' => $request->input('institution'),
            'role' => 3,
            // Role value 3
            'status' => 1, // Status value 1
        ]);
        event(new Registered($user));

        return redirect(route('login'))->with('success', 'Registrasi berhasil! Silakan login.');


        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME_USER);
    }


}