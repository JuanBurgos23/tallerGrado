<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotiDenuncua extends Notification
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Asignación de Caso - FELCC')
                    ->greeting('Hola ' . $notifiable->name . ',')
                    ->line('Usted ha sido asignado al siguiente caso:')
                    ->line('Número de Caso: ' . $this->denuncia->caso)
                    ->line('Por favor, aproxímese a las oficinas para más detalles.')
                    ->line('Gracias por su atención.')
                    ->salutation('Saludos, FELCC')
                    ->view('pages.emails.notificacion_caso',['notifiable' => $notifiable, 'denuncia' => $this->denuncia]);
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
