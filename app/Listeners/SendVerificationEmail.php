<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\verificationRegMail;
use App\Models\EmailVerification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail implements ShouldQueue
{

    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event ): void
    {
        $otp = rand(100000, 999999);

        //save OTP to DB
        EmailVerification::create([
            'user_id' => $event->user->id,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);
        //send email
        Mail::to($event->user->email)->send(new verificationRegMail($otp , $event->user->id));
    }
}
