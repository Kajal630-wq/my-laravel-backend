<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class WhatsAppController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'to' => 'required|string',
            'message' => 'required|string',
        ]);

        // Option 1: Using Twilio
        // $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        // $message = $twilio->messages->create(
        //     'whatsapp:' . $request->to,
        //     [
        //         'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER'),
        //         'body' => $request->message
        //     ]
        // );

        // Option 2: Using WhatsApp Business API (Meta)
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . env('META_ACCESS_TOKEN'),
        //     'Content-Type' => 'application/json',
        // ])->post('https://graph.facebook.com/v18.0/' . env('META_PHONE_NUMBER_ID') . '/messages', [
        //     'messaging_product' => 'whatsapp',
        //     'to' => $request->to,
        //     'type' => 'text',
        //     'text' => ['body' => $request->message]
        // ]);

        // Option 3: Using third-party service (WATI, MessageBird, etc.)
        // $response = Http::post('https://api.wati.io/api/v1/sendTemplateMessage', [
        //     'to' => $request->to,
        //     'message' => $request->message
        // ]);

        // Option 4: Using a webhook to a separate service
        // $response = Http::post(env('WHATSAPP_WEBHOOK_URL'), [
        //     'to' => $request->to,
        //     'message' => $request->message
        // ]);

        return response()->json([
            'success' => true,
            'message' => 'WhatsApp message sent successfully'
        ]);
    }
}