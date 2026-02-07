<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI; // If using openai-php/laravel

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json([
                'success' => false,
                'reply' => 'Please provide a message.'
            ]);
        }

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini', // or 'gpt-3.5-turbo'
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant. Be concise and friendly.'],
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

            $reply = $response->choices[0]->message->content;

            return response()->json([
                'success' => true,
                'reply' => $reply
            ]);

        } catch (\Exception $e) {
            \Log::error('AI Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'reply' => 'Sorry, I encountered an error. Please try again later.'
            ]);
        }
    }
}