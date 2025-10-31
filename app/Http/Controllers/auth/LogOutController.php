<?php

namespace App\Http\Controllers\auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/signin')->with('success', 'Logged out successfully.');
    }
}
