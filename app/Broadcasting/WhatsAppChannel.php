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
        $url = 'https://graph.facebook.com/v20.0/343006412232213/messages';
        //Aqui va el token
        $token = 'EAAXCOZCHCNbMBO9XMVBggrC6Ye7AY8MEriQYyh4WChBQljuJ5eg1lf9LdUKV3higCDT5cnPXRJH5NGNW24VTfYoB5W3BN6aF5IZBZBlJSKS1Q187qwzFoniCNC9mBiQ336F9OZA5iqSSiP95pUo7JZBXljET0JjUlkF1IJhxpkgqQqfjNgFiIPlxxN1RmxxVwxsp7sZCTZCRkKKm95N67YJzUoKDNoZD';

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
