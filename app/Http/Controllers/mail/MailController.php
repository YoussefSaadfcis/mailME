<?php

namespace App\Http\Controllers\mail;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MailController extends Controller {

    public function index()
    {
        // Your new, more direct prompt:
        $prompt = "Write a single, short, friendly, and motivational message for someone about to start their day. Respond with *only* the message text itself, without any introductory phrases, labels, or options.";        $apiKey = env('GEMINI_API_KEY');

        // Append the API key as a query parameter to the URL
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        $response = Http::post($url, [
            'contents' => [
                ['parts' => [['text' => $prompt]]],
            ],
        ]);

        // Check if the request was successful before trying to access the response
        if ($response->successful()) {
            $message = $response->json('candidates.0.content.parts.0.text', 'Have a great day!');
            return 'message->' . $message; // Return the message itself
        } else {
            // Handle the error
            return 'Error: ' . $response->body();
        }
    }
}
