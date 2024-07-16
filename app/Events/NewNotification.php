<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Denuncia;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $denuncia;

    public function __construct(Denuncia $denuncia)
    {
        $this->denuncia = $denuncia;
    }

    public function broadcastOn()
    {
        return new Channel('notifications');
    }

    public function broadcastWith()
    {
        return ['denuncia' => $this->denuncia];
    }
}
