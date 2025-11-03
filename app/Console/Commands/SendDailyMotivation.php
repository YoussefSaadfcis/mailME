<?php

namespace App\Console\Commands;

use App\Jobs\SendMotivationEmailJob;
use App\Models\User;
use Illuminate\Console\Command;

class SendDailyMotivation extends Command
{
    protected $signature = 'mailme:send-daily';
    protected $description = 'Send daily motivational email to all users';

    public function handle()
    {
        $users = User::whereNotNull('email_verified_at')->has('character')->get();

        foreach ($users as $user) {
            if ($user->character) {
                SendMotivationEmailJob::dispatch($user);
            }
        }

        $this->info('Daily motivation emails queued successfully!');
    }
}
