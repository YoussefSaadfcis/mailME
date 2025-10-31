<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try{
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Register new Google user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(), // Google emails are verified
                    'password' => bcrypt(str()->random(12)), // dummy password
                ]);
            }
            Auth::login($user, true);
            return redirect()->route('user.home')->with('success', 'Logged in with Google!');
            
        }catch(\Exception $e){
            return redirect()->route('signin.get')->with('error','Failed to authenticate with Google.');
        }
        
    }
}
