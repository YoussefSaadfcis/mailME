<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\MotivationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;


class SendMotivationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $character = $this->user->character;
        $apiKey = env('GEMINI_API_KEY');
        $prompt = "Write a short, friendly, and motivational message for someone who is {$character->mood}, 
            motivated by {$character->motivation}, and says: '{$character->about}', and his birthdate is {$this->user->birthdate}.
            " . ($character->allow_religion_use ? "Incorporate elements of {$character->religion}." : "") . 
          "Keep it warm and positive.Respond with *only* the final message text itself, without any introductory phrases, labels, or explanations.";

        // Example with OpenAI PHP SDK:
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        $response = Http::post($url, [
            'contents' => [
                ['parts' => [['text' => $prompt]]],
            ],
        ]);

        // Check if the request was successful before trying to access the response
        if ($response->successful()) {
            $message = $response->json('candidates.0.content.parts.0.text', 'Have a great day!');
            Mail::to($this->user->email)->send(new MotivationMail($message, $this->user));
        } else {
            // Handle the error
            return 'Error: ' . $response->body();
        }

        // 💌 2. Send email
        
    }
}
