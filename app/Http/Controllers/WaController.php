<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WaController extends Controller
{
    public function sendWaNotification()
    {
        $url = '';
        $token = '';
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => '',
            'type' => 'template',
            'template' => [
                'name' => 'hello_world',
                'language' => [
                    'code' => 'en_US',
                ],
            ],
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Mensaje enviado exitosamente!'], 200);
        } else {
            return response()->json(['error' => $response->body()], $response->status());
        }

    }
}
