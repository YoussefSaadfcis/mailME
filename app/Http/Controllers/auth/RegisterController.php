<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\signupRequest;
use App\Mail\verificationRegMail;
use App\Models\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        // send OTP
        $otp = rand(100000, 999999);

        EmailVerification::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);
        Mail::to($request->email)->send(new verificationRegMail($otp));
        // Redirect to a desired location after successful signup
        return redirect()->route('verify.email.form', ['id' => $user->id])
            ->with('success', 'Welcome to mailME!');

    }
}
