<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsuarioCorreoDenuncia extends Notification
{
    use Queueable;

    protected $denuncia;
    protected $oficial;
    protected $fiscal;

    /**
     * Create a new notification instance.
     *
     * @param $denuncia La instancia de la denuncia
     * @param $oficial La instancia del oficial asignado
     * @param $fiscal La instancia del fiscal asignado
     */
    public function __construct($denuncia, $oficial, $fiscal)
    {
        $this->denuncia = $denuncia;
        $this->oficial = $oficial;
        $this->fiscal = $fiscal;
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
            ->greeting('Estimado ' . $notifiable->name)
            ->line('Se le ha asignado el siguiente caso:')
            ->line('Número de Caso: ' . $this->denuncia->caso)
            ->line('Investigador asignado: ' . $this->oficial->nombre_completo)
            ->line('Fiscal asignado: ' . $this->fiscal->nombre_completo)
            ->line('Por favor, acérquese a las oficinas de la FELCC para firmar su denuncia y realizar el seguimiento correspondiente.')
            ->salutation('Saludos, FELCC')
            ->view('pages.emails.usuario_notificacionDen',['notifiable' => $notifiable, 'denuncia' => $this->denuncia,'oficial' => $this->oficial,
            'fiscal' => $this->fiscal]);
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
