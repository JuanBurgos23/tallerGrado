<?php

namespace App\Notifications;

use App\Models\Denuncia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class DenunciaNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $denuncia;

    public function __construct(Denuncia $denuncia)
    {
        $this->denuncia = $denuncia;
    }

    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'denuncia' => $this->denuncia,
        ]);
    }
}
