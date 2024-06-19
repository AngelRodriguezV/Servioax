<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);
        //Aqui va la url
        $url = '';
        //Aqui va el token
        $token = '';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $message['to'],
            'type' => 'template',
            'template' => [
                'name' => $message['template_name'],
                'language' => [
                    'code' => $message['language_code'],
                ],
            ],
        ]);

        if (!$response->successful()) {
            throw new \Exception('Error sending WhatsApp message: ' . $response->body());
        }
    }
}
