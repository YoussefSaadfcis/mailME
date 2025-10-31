<?php

namespace App\Http\Controllers\auth;

use Illuminate\Routing\Controller;
use App\Http\Requests\signinRequest;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function show_signin_page()
    {
        return view("user.auth.signin");
    }

    public function signin(signinRequest $request)
    {
        // Validate the request data
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            $request->session()->regenerate();
            return redirect()->route('user.home');
        }

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
