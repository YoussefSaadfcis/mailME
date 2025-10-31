<?php

namespace App\Http\Controllers\auth;

use App\Events\UserRegistered;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForgetPasswordController extends Controller
{
    public function index()
    {
        return view('user.auth.forget-password');
    }

    public function sendResetOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        event(new UserRegistered($user));

        return redirect()->route('password.reset.verifyOTP', ['id' => $user->id]);
    }
    public function verifyOTP1($id)
    {
        return view('user.auth.verify-reset-otp', ['id' => $id]);
    }

    public function verifyOTP2(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate(['otp' => 'required|digits:6']);

        $record = $user->emailVerification;

        if (!$record) {
            return back()->withErrors(['otp' => 'No verification record found.']);
        }

        if ($record->otp === $request->otp && now()->lt($record->expires_at)) {
            Log::info("User reset email: " . $user->email);
            Log::info("OTP used: " . $request->otp);

            $record->delete(); // clean up record

            return redirect()->route('changePassword.get', ['id' => $user->id])->with('success', 'Email verified successfully!');
        }


        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('user.auth.change-password', ['email' => $user->email, 'id' => $id]);
    }
    public function UpdatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        if ($user->email == $request->email) {
            Log::info("Password change requested for: " . $user->email);
            $user->password = bcrypt($request->password);
            $user->save();
        } else {
            return back()->withErrors(['email' => 'Email mismatch.']);
        }

        return redirect()->route('signin.get')->with('success', 'Password updated successfully. Please sign in with your new password.');
    }
}
