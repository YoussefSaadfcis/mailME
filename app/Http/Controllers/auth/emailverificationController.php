<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class emailverificationController extends Controller
{
    public function verifyForm($id)
    {
        return view('user.auth.verify-email', ['id' => $id]);
    }

    public function verifyOtp(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate(['otp' => 'required|digits:6']);

        $record = $user->emailVerification;

        if (!$record) {
            return back()->withErrors(['otp' => 'No verification record found.']);
        }

        if ($record->otp === $request->otp && now()->lt($record->expires_at)) {
            $user->update(['email_verified_at' => now()]);
            $record->delete(); // clean up record
            Auth::login($user);
            return "user verified and logged in[$user->name]";
          //  return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }
}
