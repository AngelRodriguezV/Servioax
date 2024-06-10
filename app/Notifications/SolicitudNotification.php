<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Models\Solicitud;

class SolicitudNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'solicitud' => $this->solicitud->id,
            'cliente_nombre' =>$this->solicitud->cliente->nombre,
            'cliente_apellidoP' =>$this->solicitud->cliente->apellido_paterno,
            'cliente_apellidoM' =>$this->solicitud->cliente->apellido_materno,
            'servicio_nombre' =>$this->solicitud->servicio->nombre,
            'hora_inicio' =>$this->solicitud->hora_inicio,
            'hora_termino' =>$this->solicitud->hora_termino,
            'estatus' =>$this->solicitud->estatus
        ];
    }
}
