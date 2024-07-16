<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class SmsNotificacion extends Notification
{
    use Queueable;
    protected $denuncia;

    /**
     * Create a new notification instance.
     */
    public function __construct($denuncia)
    {
        $this->denuncia = $denuncia;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['nexmo'];
    }

    public function toNexmo($notifiable)
    {
        $nombre = $notifiable->nombre_completo;
        $caso = $this->denuncia->caso;

        $mensaje = "Estimado(a) {$nombre}, usted ha sido asignado(a) al caso {$caso}. Por favor, acérquese a la oficina de la FELCC para más información. Gracias.";

        return (new NexmoMessage)
            ->content($mensaje);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
