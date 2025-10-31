<?php

namespace App\Http\Controllers\auth;

use App\Events\UserRegistered;
use Illuminate\Routing\Controller;
use App\Http\Requests\signupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view("user.auth.signup");
    }

    public function store(signupRequest $request)
    {
        //create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password),
        ]);

        event(new UserRegistered($user));
        // Redirect to a desired location after successful signup
        return redirect()->route('verify.email.form', ['id' => $user->id])
            ->with('success', 'Welcome to mailME!');
    }
}
