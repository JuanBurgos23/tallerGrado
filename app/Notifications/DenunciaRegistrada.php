<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DenunciaRegistrada extends Notification
{
    use Queueable;

    protected $denuncia;
    protected $denunciante;

    public function __construct($denuncia, $denunciante)
    {
        $this->denuncia = $denuncia;
        $this->denunciante = $denunciante;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Se ha registrado una nueva denuncia.')
                    ->action('Ver Denuncia', url('/denuncias/' . $this->denuncia->id))
                    ->line('Gracias por usar nuestra aplicación!');
    }

    public function toArray($notifiable)
    {
        return [
            'denuncia_id' => $this->denuncia->id,
            'denunciante' => $this->denunciante->nombre,
            'fecha' => $this->denuncia->created_at->format('Y-m-d H:i:s'),
            'estado' => $this->denuncia->estado, // Incluyendo el estado
        ];
    }
}
