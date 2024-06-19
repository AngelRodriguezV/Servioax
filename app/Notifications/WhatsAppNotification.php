<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Broadcasting\WhatsAppChannel;

class WhatsAppNotification extends Notification
{
    use Queueable;

    public function __construct($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsApp($notifiable)
    {
        return [
            'to' => $this->phoneNumber,
            'template_name' => 'hello_world',
            'language_code' => 'en_US',
        ];
    }
}